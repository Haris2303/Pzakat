<?php

class Norek_model
{

    private $table  = 'tb_norek';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataNorek()
    {
        $query = "SELECT * FROM $this->table";
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
        $gambar     = Utility::uploadImage($dataFile, 'norek');

        // cek gambar diupload
        if (!is_string($gambar)) return 'Gagal Upload Gambar!';

        // cek norek 
        $cek = "SELECT norek FROM $this->table WHERE norek = $norek";
        $this->db->query($cek);
        $resultCek = $this->db->resultSet();
        if (count($resultCek) > 0) return 'Norek sudah tersedia!';

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
}
