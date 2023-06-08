<?php

class Transaksi extends Controller {

    public function index($slug): void 
    {
        $data = [
            "judul" => "Form Donasi",
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug)
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/index', $data);
        $this->view('template/normalfooter', $data);
    }

}