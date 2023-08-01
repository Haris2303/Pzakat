<?php

class Laporan extends Controller {

    public function index(): void {
        $this->view('error/404');
        exit;
    }

    public function zakat(): void {
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Zakat');
        $data = [
            "pdf" => new LaporanProgram('Zakat'),
            "nama_program" => "Zakat",
            "data_content" => $dataLaporan
        ];

        $this->view('template/laporan', $data);
    }

    public function infaq(): void {
        $dataLaporan = $this->model('Laporan_model')->getLaporan('infaq');
        $data = [
            "pdf" => new LaporanProgram('Infaq'),
            "nama_program" => "Infaq",
            "data_content" => $dataLaporan
        ];

        $this->view('template/laporan', $data);
    }

    public function donasi(): void {
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Donasi');
        $data = [
            "pdf" => new LaporanProgram('Donasi'),
            "nama_program" => "Donasi",
            "data_content" => $dataLaporan
        ];

        $this->view('template/laporan', $data);
    }

    public function qurban(): void {
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Qurban');
        $data = [
            "pdf" => new LaporanProgram('Qurban'),
            "nama_program" => "Qurban",
            "data_content" => $dataLaporan
        ];

        $this->view('template/laporan', $data);
    
    }
    public function ramadhan(): void {
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Ramadhan');
        $data = [
            "pdf" => new LaporanProgram('Ramadhan'),
            "nama_program" => "Ramadhan",
            "data_content" => $dataLaporan
        ];

        $this->view('template/laporan', $data);
    }

}