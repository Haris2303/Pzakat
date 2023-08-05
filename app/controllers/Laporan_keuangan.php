<?php

class Laporan_keuangan extends Controller {

    public function index(): void
    {
        $data = [
            "judul" => "Laporan Keuangan",
            "laporan" => $this->model('Laporantahunan_model')->getData()
        ];

        $this->view('template/header', $data);
        $this->view('laporan_keuangan/index', $data);
        $this->view('template/footer', $data);
    }

}