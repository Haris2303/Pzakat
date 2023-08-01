<?php

class Banner_model {

    private $table = 'tb_banner';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataBanner(): array
    {
        $query = "SELECT * FROM $this->table";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambahDataBanner($dataPost, $dataFile)
    {
        $username_amil = $dataPost['username_amil'];
        $gambar = Utility::uploadImage($dataFile, 'banner');
        $link = $dataPost['link'];

        // cek gambar
        if(!is_string($gambar)) return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, :username, :gambar, :link, NOW())";
        $this->db->query($query);
        $this->db->bind('username', $username_amil);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('link', $link);
        $this->db->execute();

        return $this->db->rowCount();

    }

    public function hapusDataBanner($id): int
    {
        $query = "DELETE FROM $this->table WHERE id_banner = :id_banner";
        $this->db->query($query);
        $this->db->bind('id_banner', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

}