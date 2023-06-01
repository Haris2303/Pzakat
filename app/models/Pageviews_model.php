<?php

class Pageviews_model
{

  private $table = 'tb_views';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllDataBerita(): array
  {

    $query = "SELECT * FROM $this->table WHERE jenis_views = 'Berita' ORDER BY id_views DESC";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getAllDataArtikel(): array
  {

    $query = "SELECT * FROM $this->table WHERE jenis_views = 'Artikel' ORDER BY id_views DESC";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getDataViewBySlug($slug): array
  {

    $query = "SELECT * FROM $this->table WHERE slug = :slug";
    $this->db->query($query);
    $this->db->bind('slug', $slug);
    $result = $this->db->single();
    return $result;
  }

  public function getAllDataBeritaLimit($limit): array
  {
    $query = "SELECT judul, slug, gambar, content, datetime FROM $this->table WHERE jenis_views = 'Berita' ORDER BY id_views DESC LIMIT $limit";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  public function getAllDataArtikelLimit($limit): array 
  {
    $query = "SELECT judul, slug, gambar, datetime FROM $this->table WHERE jenis_views = 'Artikel' ORDER BY id_views DESC LIMIT $limit ";
    $this->db->query($query);
    return $this->db->resultSet();  
  }

  public function tambahBerita($dataPost, $dataFile)
  {

    // initialisasi
    $namaPenulis  = $dataPost['username'];
    $judul        = $dataPost['judul'];
    $jenis_view  = $dataPost['jenis_view'];
    $content      = $dataPost['content'];

    // initialisasi nama file baru ke variabel gambar
    $gambar = Utility::uploadImage($dataFile, 'views');

    // cek jika gambar gagal terupload
    if(!is_string($gambar)) return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';

    // buat slug dari judul
    $slug = join('-', explode(' ', strtolower($dataPost['judul'])));

    // insert data
    $query = "INSERT INTO $this->table VALUES(NULL, :namaPenulis, :jenisView, :judul, :slug, :gambar, :content, NOW())";
    $this->db->query($query);
    $this->db->bind('namaPenulis', $namaPenulis);
    $this->db->bind('jenisView', $jenis_view);
    $this->db->bind('judul', htmlspecialchars($judul));
    $this->db->bind('slug', $slug);
    $this->db->bind('gambar', $gambar);
    $this->db->bind('content', $content);
    $this->db->execute();

    return ($this->db->rowCount() > 0) ? $this->db->rowCount() : 'Gagal Upload Berita!';
  }

  public function ubahView($dataPost, $dataFiles): int
  {

    // initialisasi
    $slug         = $dataPost['slug'];
    $namaPenulis  = $dataPost['penulis'];
    $judul        = $dataPost['judul'];
    $gambarLama   = $dataPost['gambarlama'];
    $content      = $dataPost['content'];
    $gambarBaru   = Utility::uploadImage($dataFiles, 'views');
    $slugbaru     = strtolower(join('-', explode(' ', $judul)));

    // cek gambar
    if(!is_string($gambarBaru)) {
      $gambarBaru = $gambarLama;
    } else {
      // hapus gambar lama
      unlink('/var/www/html/Pzakat/public/img/views/'.$gambarLama);
    }

    // update data
    $query = "UPDATE $this->table SET nama_penulis = :nama_penulis, judul = :judul, slug = :slugbaru, gambar = :gambar, content = :content, datetime = NOW() WHERE slug = :slug";
    $this->db->query($query);
    $this->db->bind('nama_penulis', $namaPenulis);
    $this->db->bind('judul', ucwords($judul));
    $this->db->bind('slugbaru', $slugbaru);
    $this->db->bind('gambar', $gambarBaru);
    $this->db->bind('content', $content);
    $this->db->bind('slug', $slug);
    $this->db->execute();

    return $this->db->rowCount();

  }

  public function hapusView($slug): int {

    // hapus gambar lama
    $querySelect = "SELECT gambar FROM $this->table WHERE slug = :slug";
    $this->db->query($querySelect);
    $this->db->bind('slug', $slug);
    $getImageName = $this->db->single();
    unlink('/var/www/html/Pzakat/public/img/views/'. $getImageName['gambar']);

    // delete data
    $query = "DELETE FROM $this->table WHERE slug = :slug";
    $this->db->query($query);
    $this->db->bind('slug', $slug);
    $this->db->execute();
    return $this->db->rowCount();

  }
}
