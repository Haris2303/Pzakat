<?php

class Program extends Controller
{

    /**
     * Menampilkan halaman detail program berdasarkan slug.
     * Metode ini menerima parameter slug yang digunakan untuk mengambil data program aktif berdasarkan slug dari model Program_model.
     * Jika program dengan slug tersebut ditemukan, halaman detail program akan ditampilkan.
     * Jika program dengan slug tersebut tidak ditemukan, halaman 404 (Not Found) akan ditampilkan.
     * @param string $slug Slug dari program yang akan ditampilkan.
     */
    public function index($slug = true): void
    {
        // Mengambil data program aktif dan donatur success berdasarkan slug
        $data = [
            "judul" => "Program",
            "dataProgram" => $this->model('Program_model')->getDataProgramAktifBySlug($slug),
            "donatur" => $this->model('Pembayaran_model')->getAllDataPembayaran('success', ["tanggal_pembayaran" => "DESC"], ['logic' => 'AND', 'status_pembayaran =' => 'success', "slug_program =" => $slug])
        ];

        // Memeriksa apakah program dengan slug tersebut ditemukan
        if (is_bool($data['dataProgram'])) {
            // Jika tidak ditemukan, tampilkan halaman 404 (Not Found)
            $this->view('error/404');
            exit;
        }

        // Jika ditemukan, tampilkan halaman detail program
        $this->view('template/header', $data);
        $this->view('program/index', $data);
        $this->view('template/footer', $data);
    }
}
