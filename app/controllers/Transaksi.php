<?php

class Transaksi extends Controller {

    public function index(): void 
    {
        $data = [
            "judul" => "Form Donasi"
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/index', $data);
        $this->view('template/normalfooter', $data);
    }

}