<?php

class Pengeluaran_model {

    private $table = "tb_pengeluaran";
    private $view = [
        "allDataPengeluaran"        => "vwAllDataPengeluaran",
        "allDataPengeluaranTunai"   => "vwAllDataPengeluaranTunai"
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataPengeluaran(): array
    {
        return [];
    }

    public function getAllDataPengeluaranTunai(): array
    {
        $view = $this->view['allDataPengeluaranTunai'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }


    /** 
     *
     * @method CRUD
     * 
    */
    public function tambahDataPengeluaranTunai($data)
    {
        // initial variabel
        $nama_penerima      = htmlspecialchars($data['nama-penerima']);
        $id_program         = $data['id-program'];
        $id_bank            = $data['id-bank'];
        $nominal            = $data['nominal'];
        $alamat             = $data['alamat'];
        $nohp               = $data['nohp'];
        $jenis_pengeluaran  = 'uang';
        $keterangan         = htmlspecialchars($data['keterangan']);
    }

}