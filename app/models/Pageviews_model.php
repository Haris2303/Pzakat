<?php

class Pageviews_model {

  private $table = 'tb_views';
  private $db;

  public function __construct() 
  {
    $this->db = new Database();
  }

  public function getAllDataBerita(): array {

    $query = "SELECT * FROM $this->table";
    $this->db->query($query);
    return $this->db->resultSet();

  }

  public function getDataViewBySlug($slug): array {

    $query = "SELECT * FROM $this->table WHERE slug = :slug";
    $this->db->query($query);
    $this->db->bind('slug', $slug);
    $result = $this->db->single();
    return $result;

  } 

  public function tambahBerita($dataPost, $dataFile) {

    // initialisasi
    $namaPenulis  = $dataPost['username'];
    $judul        = $dataPost['judul'];
    $jenis_views  = $dataPost['jenis_views'];
    $content      = $dataPost['content'];

    // initialisasi file gambar
    $namaFile   = $dataFile['gambar']['name'];
    $ukuran     = $dataFile['gambar']['size'];
    $errorFile  = $dataFile['gambar']['error'];
    $tmpName    = $dataFile['gambar']['tmp_name'];

    // cek gambar di upload atau tidak
    if($errorFile === 4) return 0;

    // cek ekstensi gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if(!in_array($ekstensiGambar, $ekstensiGambarValid)) return 0;

    // cek ukuran gambar > 2mb
    if($ukuran === 2000000) return 0;

    // generate nama file baru 
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.' . $ekstensiGambar;

    // gambar siap diuplaod
    if(move_uploaded_file($tmpName, '/var/www/html/Pzakat/public/img/views/' . $namaFileBaru)) {
      // initialisasi nama file baru ke variabel gambar
      $gambar = $namaFileBaru;
  
      // buat slug dari judul
      $slug = join('-',explode(' ', strtolower($dataPost['judul'])));
  
      // insert data
      $query = "INSERT INTO $this->table VALUES(NULL, :namaPenulis, :jenisViews, :judul, :slug, :gambar, :content, NOW())";
      $this->db->query($query);
      $this->db->bind('namaPenulis', $namaPenulis);
      $this->db->bind('jenisViews', 'Berita');
      $this->db->bind('judul', htmlspecialchars($judul));
      $this->db->bind('slug', $slug);
      $this->db->bind('gambar', $gambar);
      $this->db->bind('content', $content);
      $this->db->execute();
  
      return $this->db->rowCount();
    }

    return 0;

  }

}