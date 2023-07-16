<?php

class Laporan_model {

    private $view = [
        "laporanZakat" => "vwLaporanZakat"
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLaporan() 
    {
        $view = $this->view['laporanZakat'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

}