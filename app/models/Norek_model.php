<?php

class Norek_model
{

    private $table  = 'tb_norek';
    private $view = ["allNorekHaveSaldo" => "vwAllNorekHaveSaldo"];
    private $db;
    private $baseModel;
    
    public function __construct()
    {
        $this->db = new Database();
        $this->baseModel = new BaseModel($this->table);
    }

    public function getAllDataNorekHaveSaldo()
    {
        $view = $this->view['allNorekHaveSaldo'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
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
     * @method getDataBankJsonDecode 
     * @param null
     * @return array
     */

    public function getDataBankJsonDecode(): array
    {
        $url = BASEURL . "/static/api/bank/bank.json";
        $result = file_get_contents($url);
        return json_decode($result, true);
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------
     *                  ACTION DATA
     * --------------------------------------------------------------------------------------------------------------------------
     */

     /**
      * @param array $dataPost data dari post
      */
    public function tambahDataNorek(array $dataPost): int|string
    {
        // initialisasi variabel
        $nama_pemilik   = ucwords(strtolower($dataPost['nama-pemilik']));
        $nama_bank      = strtoupper($dataPost['nama-bank']);
        $norek          = $dataPost['norek'];
        $jenis_program  = ucwords($dataPost['jenis-program']);
        $saldo_donasi   = 0;
        $gambar         = strtolower(join('-', explode(' ', $nama_bank))) . '.jpeg';
        $uuid           = Utility::generateUUID();

        // cek norek
        if ($this->baseModel->isData(["norek" => $norek])) return 'Norek sudah tersedia!';

        // insert norek
        $query = "INSERT INTO $this->table VALUES(NULL, :uuid, :nama_pemilik, :nama_bank, :norek, :jenis_program, :saldo_donasi, :gambar)";
        $this->db->query($query);
        $this->db->bind('uuid', $uuid);
        $this->db->bind('nama_pemilik', $nama_pemilik);
        $this->db->bind('nama_bank', $nama_bank);
        $this->db->bind('norek', $norek);
        $this->db->bind('jenis_program', $jenis_program);
        $this->db->bind('saldo_donasi', $saldo_donasi);
        $this->db->bind('gambar', $gambar);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataNorek($dataPost): int|string {
        
        // init variabel
        $id_norek    = $dataPost['id'];
        $namapemilik = ucwords(strtolower($dataPost['nama-pemilik']));
        $norek       = $dataPost['norek'];

        // cek norek
        if($this->baseModel->isData(["norek" => $norek]) && $this->baseModel->isData(["id_norek" => $id_norek])) return "Nomor rekening sudah terdaftar!";

        $data = [
            "nama_pemilik" => $namapemilik,
            "norek" => $norek
        ];

        // update data
        return $this->baseModel->updateData($data, ["id_norek" => $id_norek]);

    }

    public function deleteData($uuid): int
    {
        // delete data
        return $this->baseModel->deleteData(["UUID" => $uuid]);
    }
}
