<?php

class Laporan extends Controller {

    public function index(): void {
        $this->view('error/404');
        exit;
    }

    public function zakat(): void {
        $data = [
            "dataZakat" => $this->model('Laporan_model')->getLaporanZakat()
        ];

        $this->view('report/zakat', $data);
    }

    public function infaq(): void {
        $data = [
            "dataInfaq" => $this->model('Laporan_model')->getLaporanInfaq()
        ];

        $this->view('report/infaq', $data);
    }

}