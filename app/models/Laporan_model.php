<?php

class Laporan_model {

    private $view = [
        "laporanZakat" => "vwLaporanZakat",
        "laporanInfaq" => "vwLaporanInfaq",
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getLaporanZakat() 
    {
        $view = $this->view['laporanZakat'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getLaporanInfaq() 
    {
        $view = $this->view['laporanInfaq'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

}