<?php

class Laporan_keuangan extends Controller
{

    /**
     * Index: Menampilkan halaman laporan keuangan tahunan.
     *
     * @return void
     */
    public function index(): void
    {
        // Data yang akan dikirim ke halaman laporan keuangan
        $data = [
            "judul" => "Laporan Keuangan",
            "laporan" => $this->model('Laporantahunan_model')->getData()
        ];

        // Load view untuk header, halaman laporan keuangan, dan footer
        $this->view('template/header', $data);
        $this->view('laporan_keuangan/index', $data);
        $this->view('template/footer', $data);
    }
}
