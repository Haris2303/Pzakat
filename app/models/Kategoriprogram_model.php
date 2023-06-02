<?php

class Kategoriprogram_model {

    private $table = 'tb_kategori_program';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }   

    public function getAllDataKategoriProgram(): array
    {
        $query = "SELECT * FROM $this->table";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambahDataKategori($data): int {
        // assignment data post
        $username_amil = $data['username_amil'];
        $nama_kategori = $data['nama_kategori'];

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, :username_amil, :nama_kategori, NOW())";
        $this->db->query($query);
        $this->db->bind('username_amil', $username_amil);
        $this->db->bind('nama_kategori', ucwords($nama_kategori));
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataKategori($id): int {
        $query = "DELETE FROM $this->table WHERE id_kategori_program = :id_kategori_program";
        $this->db->query($query);
        $this->db->bind('id_kategori_program', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

}