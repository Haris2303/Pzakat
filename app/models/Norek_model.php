<?php

class Norek_model
{

    private $view   = 'vwAllNorek';
    private $table  = 'tb_norek';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataNorek()
    {
        $query = "SELECT * FROM vwAllNorek";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getDataNorekById($id)
    {
        $query = "SELECT vwAllNorek FROM $this->table ";
    }

    public function tambahDataNorek($dataPost, $dataFile)
    {
        // initialisasi variabel
        $nama_pemilik    = $dataPost['nama-pemilik'];
        $nama_bank  = $dataPost['nama-bank'];
        $norek      = $dataPost['norek'];
        $gambar     = $this->upload($dataFile);

        // cek gambar diupload
        if(!is_string($gambar)) return 'Gagal Upload Gambar!';

        // cek norek 
        $cek = "SELECT norek FROM $this->table WHERE norek = $norek";
        $this->db->query($cek);
        $resultCek = $this->db->resultSet();
        if(count($resultCek) > 0) return 'Norek sudah tersedia!';

        // insert norek
        $query = "INSERT INTO $this->table VALUES(NULL, :nama_pemilik, :nama_bank, :norek, :gambar)";
        $this->db->query($query);
        $this->db->bind('nama_pemilik', $nama_pemilik);
        $this->db->bind('nama_bank', $nama_bank);
        $this->db->bind('norek', $norek);
        $this->db->bind('gambar', $gambar);
        $this->db->execute();

        return $this->db->rowCount();

    }

    private function upload($dataFile)
    {
        // initialisasi file gambar
        $namaFile   = $dataFile['gambar']['name'];
        $ukuran     = $dataFile['gambar']['size'];
        $errorFile  = $dataFile['gambar']['error'];
        $tmpName    = $dataFile['gambar']['tmp_name'];

        // cek gambar di upload atau tidak
        if ($errorFile === 4) return 0;

        // cek ekstensi gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) return 0;

        // cek ukuran gambar > 2mb
        if ($ukuran === 2000000) return 0;

        // generate nama file baru 
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.' . $ekstensiGambar;

        // gambar siap upload
        if (move_uploaded_file($tmpName, '/var/www/html/Pzakat/public/img/norek/' . $namaFileBaru)) return $namaFileBaru;
        else return 0;
    }
}
