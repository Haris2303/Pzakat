<?php

class Laporan extends Controller {

    public function zakat(): void {
        $data = [
            "dataLaporan" => $this->model('Laporan_model')->getLaporan()
        ];

        $this->view('report/zakat', $data);
    }

}