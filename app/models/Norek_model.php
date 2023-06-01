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
        $query = "SELECT * FROM $this->table WHERE id_norek = :id_norek";
        $this->db->query($query);
        $this->db->bind('id_norek', $id);
        return $this->db->single();
    }

    public function tambahDataNorek($dataPost, $dataFile)
    {
        // initialisasi variabel
        $nama_pemilik    = $dataPost['nama-pemilik'];
        $nama_bank  = $dataPost['nama-bank'];
        $norek      = $dataPost['norek'];
        $gambar     = Utility::uploadImage($dataFile, 'norek');

        // cek gambar error
        if($dataFile['gambar']['error'] === 4) return 'Mohon untuk upload gambar!';

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

    public function ubahDataNorek($dataPost, $dataFiles) {
        
        $id_norek    = $dataPost['id'];
        $namabank    = $dataPost['nama-bank'];
        $namapemilik = $dataPost['nama-pemilik'];
        $norek       = $dataPost['norek'];
        $gambarLama  = $dataPost['gambar-lama'];
        $gambarBaru  = Utility::uploadImage($dataFiles, 'norek');

        // cek gambar diupload
        if(!is_string($gambarBaru)) {
            $gambarBaru = $gambarLama;
        } else {
            // hapus gambar lama
            unlink('/var/www/html/Pzakat/public/img/norek/'.$gambarLama);
        }


        // update data
        $query = " UPDATE $this->table SET 
                        nama_bank = :nama_bank,
                        nama_pemilik = :nama_pemilik,
                        norek = :norek,
                        gambar = :gambar
                    WHERE id_norek = :id_norek";
        
        $this->db->query($query);
        $this->db->bind('id_norek', $id_norek);
        $this->db->bind('nama_bank', $namabank);
        $this->db->bind('nama_pemilik', $namapemilik);
        $this->db->bind('norek', $norek);
        $this->db->bind('gambar', $gambarBaru);
        $this->db->execute();

        return $this->db->rowCount();

    }

    public function hapusDataNorekById($id)
    {
        // hapus gambar lama
        $querySelect = "SELECT gambar FROM $this->table WHERE id_norek = :id_norek";
        $this->db->query($querySelect);
        $this->db->bind('id_norek', $id);
        $getImageName = $this->db->single();
        unlink('/var/www/html/Pzakat/public/img/norek/' . $getImageName['gambar']);

        // delete data
        $query = "DELETE FROM $this->table WHERE id_norek = :id_norek";
        $this->db->query($query);
        $this->db->bind('id_norek', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
