<?php

class Pengeluaran extends Controller {

    public function index() :void 
    {
        $data = [
            "judul" => "Pengeluaran Donasi",
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/index', $data);
        $this->view('dashboard/footer', $data);
    }

}