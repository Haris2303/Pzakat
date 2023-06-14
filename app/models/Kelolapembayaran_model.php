<?php

class Kelolapembayaran_model {

    private $vw = [
        "dataPending"    => "vwPembayaranPending",
        "dataKonfirmasi" => "vwPembayaranKonfirmasi",
        "dataSukses"     => "vwPembayaranSukses",
        "dataGagal"      => "vwPembayaranGagal"
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataPembayaranPending()
    {
        $view = $this->vw['dataPending'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

}