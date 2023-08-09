<?php

class Kategoriprogram_model {

    private $table = 'tb_kategoriprogram';
    private $db;
    private $baseModel;

    public function __construct()
    {
        $this->db = new Database();
        $this->baseModel = new BaseModel($this->table);
    }   

    public function getAllDataKategoriProgram(): array
    {
        $query = "SELECT * FROM $this->table";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * ------------------------------------------------------------------------------------------------------------------------------------------------
     *                      GET DATA KATEGORI PROGRAM
     * ------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * @param string $status value aktif|pasif
     */
    public function getAllKategoriProgram(string $status = null): array 
    {
        // cek apakah $status null atau tidak
        (is_null($status)) ? $this->baseModel->selectData() : $this->baseModel->selectData(null, null, [], ["status =" => $status]);
        return $this->baseModel->fetchAll();
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

    /**
     * ----------------------------------------------------------------------------------------------------------------------------------------------------
     *              UPDATE DATA KATEGORI PROGRAM
     * ----------------------------------------------------------------------------------------------------------------------------------------------------
     */

    public function ubahStatusProgram(int $id, string $status): int {
        return $this->baseModel->updateData(["status" => $status], ["id_kategoriprogram" => $id]);
    }
}