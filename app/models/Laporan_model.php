<?php

class Laporan_model {

    private $view = [
        "laporan"   => "vwAllLaporan",
        "laporanZakat" => "vwLaporanZakat",
        "laporanInfaq" => "vwLaporanInfaq",
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------------------------------------------
     *                          GET DATA LAPORAN
     * --------------------------------------------------------------------------------------------------------------------------------------------------------------
     * @method getLaporan (Mengambil data laporan bisa semua data atau data yang ditentukan)
     * @param param1(NULL|Zakat|Infaq|Donasi|Qurban|Ramadhan),param2(NULL|Tunai|Barang)
     * @var query
     */
    public function getLaporan(string $jenis_program = null, string $jenis_pembayaran = null): array
    {
        // init view
        $view = $this->view['laporan'];

        // set jenis_program jadi kapital dan jenis pembayaran lowercase
        ucwords($jenis_program);
        strtolower($jenis_pembayaran);

        // jika tidak ada argument yang diberikan
        if(is_null($jenis_program) && is_null($jenis_pembayaran)) $query = "SELECT * FROM $view";

        // jika argument jenis_program tidak null
        if(!is_null($jenis_program)) $query = "SELECT * FROM $view WHERE jenis_program = '$jenis_program'";

        // jika argument jenis_pembayaran tidak null
        if(!is_null($jenis_pembayaran)) $query = "SELECT * FROM $view WHERE jenis_pembayaran = '$jenis_pembayaran'";

        // jika 2 argument tidak null
        if(!is_null($jenis_program) && !is_null($jenis_pembayaran)) $query = "SELECT * FROM $view WHERE (jenis_program = '$jenis_program' AND jenis_pembayaran = '$jenis_pembayaran')";

        // siapkan query
        $this->db->query($query);

        return $this->db->resultSet();
    }

}