<?php

class Transaksi extends Controller {

    public function index($slug): void 
    {
        $data = [
            "judul" => "Form Donasi",
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug),
            "dataNorek" => $this->model('Norek_model')->getAllDataNorek()
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/index', $data);
        $this->view('template/normalfooter', $data);
    }

    public function summary(): void 
    {
        $data = [
            "judul" => "Summary",
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/summary', $data);
        $this->view('template/normalfooter', $data);
    }

}