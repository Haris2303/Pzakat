<?php

class Laporan extends Controller
{

    public function index(): void
    {
        // Set HTTP response code to 404
        http_response_code(404);

        // Load the error 404 view with a clear error message
        $data = [
            "judul" => "Halaman Tidak Ditemukan",
            "pesan" => "Maaf, halaman yang Anda cari tidak ditemukan."
        ];
        $this->view('error/404', $data);
        exit;
    }

    /**
     * 
     * @method zakat
     * 
     * Menghasilkan laporan PDF untuk program "Zakat"
     */
    public function zakat(): void
    {
        // Ambil data laporan dari model
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Zakat');

        // Siapkan data yang akan digunakan dalam tampilan PDF
        $data = [
            "pdf" => new LaporanProgram('Zakat'), // Objek untuk membuat laporan PDF
            "nama_program" => "Zakat",
            "data_content" => $dataLaporan
        ];

        // Tampilkan tampilan laporan menggunakan view 'template/laporan'
        $this->view('template/laporan', $data);
    }

    /**
     * 
     * @method infaq
     * 
     * Menghasilkan laporan PDF untuk program "Infaq"
     */
    public function infaq(): void
    {
        // Ambil data laporan dari model
        $dataLaporan = $this->model('Laporan_model')->getLaporan('infaq');

        // Siapkan data yang akan digunakan dalam tampilan PDF
        $data = [
            "pdf" => new LaporanProgram('Infaq'), // Objek untuk membuat laporan PDF
            "nama_program" => "Infaq",
            "data_content" => $dataLaporan
        ];

        // Tampilkan tampilan laporan menggunakan view 'template/laporan'
        $this->view('template/laporan', $data);
    }

    /**
     * 
     * @method donasi
     * 
     * Menghasilkan laporan PDF untuk program "Donasi"
     */
    public function donasi(): void
    {
        // Ambil data laporan dari model
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Donasi');

        // Siapkan data yang akan digunakan dalam tampilan PDF
        $data = [
            "pdf" => new LaporanProgram('Donasi'), // Objek untuk membuat laporan PDF
            "nama_program" => "Donasi",
            "data_content" => $dataLaporan
        ];

        // Tampilkan tampilan laporan menggunakan view 'template/laporan'
        $this->view('template/laporan', $data);
    }

    /**
     * 
     * @method qurban
     * 
     * Menghasilkan laporan PDF untuk program "Qurban"
     */
    public function qurban(): void
    {
        // Ambil data laporan dari model
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Qurban');

        // Siapkan data yang akan digunakan dalam tampilan PDF
        $data = [
            "pdf" => new LaporanProgram('Qurban'), // Objek untuk membuat laporan PDF
            "nama_program" => "Qurban",
            "data_content" => $dataLaporan
        ];

        // Tampilkan tampilan laporan menggunakan view 'template/laporan'
        $this->view('template/laporan', $data);
    }

    /**
     * 
     * @method ramadhan
     * 
     * Menghasilkan laporan PDF untuk program "Ramadhan"
     */
    public function ramadhan(): void
    {
        // Ambil data laporan dari model
        $dataLaporan = $this->model('Laporan_model')->getLaporan('Ramadhan');

        // Siapkan data yang akan digunakan dalam tampilan PDF
        $data = [
            "pdf" => new LaporanProgram('Ramadhan'), // Objek untuk membuat laporan PDF
            "nama_program" => "Ramadhan",
            "data_content" => $dataLaporan
        ];

        // Tampilkan tampilan laporan menggunakan view 'template/laporan'
        $this->view('template/laporan', $data);
    }
}
