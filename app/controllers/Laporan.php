<?php

class Laporan extends Controller {

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