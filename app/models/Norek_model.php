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

    public function getAllDataNorekByProgram($jenis_program)
    {
        $query = "SELECT * FROM $this->table WHERE jenis_program = :jenis_program";
        $this->db->query($query);
        $this->db->bind('jenis_program', $jenis_program);
        return $this->db->resultSet();
    }

    public function getDataNorekById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id_norek = :id_norek";
        $this->db->query($query);
        $this->db->bind('id_norek', $id);
        return $this->db->single();
    }

    /**
     * 
     * @param getJSON
     * 
     */

    public function getDataBankJsonDecode() 
    {
        $url = BASEURL . "/static/api/bank/bank.json";
        $result = file_get_contents($url);
        return json_decode($result, true);
    }


    public function tambahDataNorek($dataPost)
    {
        // initialisasi variabel
        $nama_pemilik   = ucwords(strtolower($dataPost['nama-pemilik']));
        $nama_bank      = strtoupper($dataPost['nama-bank']);
        $norek          = $dataPost['norek'];
        $jenis_program  = ucwords($dataPost['jenis-program']);
        $gambar         = strtolower(join('-', explode(' ', $nama_bank))) . '.jpeg';

        // cek norek 
        $cek = "SELECT norek FROM $this->table WHERE norek = $norek";
        $this->db->query($cek);
        $resultCek = $this->db->resultSet();
        if (count($resultCek) > 0) return 'Norek sudah tersedia!';

        // insert norek
        $query = "INSERT INTO $this->table VALUES(NULL, :nama_pemilik, :nama_bank, :norek, :jenis_program, :gambar)";
        $this->db->query($query);
        $this->db->bind('nama_pemilik', $nama_pemilik);
        $this->db->bind('nama_bank', $nama_bank);
        $this->db->bind('norek', $norek);
        $this->db->bind('jenis_program', $jenis_program);
        $this->db->bind('gambar', $gambar);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataNorek($dataPost) {
        
        $id_norek    = $dataPost['id'];
        $namapemilik = ucwords(strtolower($dataPost['nama-pemilik']));
        $norek       = $dataPost['norek'];

        // update data
        $query = " UPDATE $this->table SET 
                        nama_pemilik = :nama_pemilik,
                        norek = :norek
                    WHERE id_norek = :id_norek";
        
        $this->db->query($query);
        $this->db->bind('id_norek', $id_norek);
        $this->db->bind('nama_pemilik', $namapemilik);
        $this->db->bind('norek', $norek);
        $this->db->execute();

        return $this->db->rowCount();

    }

    public function hapusDataNorekById($id): int
    {
        // delete data
        $query = "DELETE FROM $this->table WHERE id_norek = :id_norek";
        $this->db->query($query);
        $this->db->bind('id_norek', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}
