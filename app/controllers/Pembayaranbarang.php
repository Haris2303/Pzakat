<?php

class Pembayaranbarang extends Controller {

    public function index(): void {
        $data = [
            "judul" => "Pembayaran bentuk Barang",
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('pembayaranbarang/index', $data);
        $this->view('dashboard/footer', $data);
    }
    
}