<?php

class Banner extends Controller
{

    /**
     * Metode untuk menampilkan halaman indeks (index) entitas "Banner".
     *
     * @return void
     */
    public function index(): void
    {
        // Mengatur data yang akan digunakan pada halaman
        $data = [
            "judul" => "Banner",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataBanner" => $this->model('Banner_model')->getAllDataBanner(),
        ];

        // Menampilkan sidebar, halaman index Banner, dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('banner/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * -------------------------------------------------------------------------------------------------------------------------
     *                      ACTION METHOD
     * -------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Metode untuk menangani aksi penambahan data "Banner".
     *
     * @return void
     */
    public function aksi_tambah_banner(): void
    {
        // Menambahkan data banner menggunakan model "Banner_model"
        $result = $this->model('Banner_model')->tambahDataBanner($_POST, $_FILES);

        // Memeriksa apakah penambahan data berhasil (result > 0)
        if ($result > 0) {
            // Menampilkan pesan sukses dan arahkan kembali ke halaman "Banner"
            Flasher::setFlash('Data Banner <strong>Berhasil</strong> ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/banner');
            exit;
        } else {
            // Jika ada kesalahan, tampilkan pesan kesalahan dan arahkan kembali ke halaman "Banner"
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/banner');
            exit;
        }
    }

    /**
     * Metode untuk menangani aksi penghapusan data "Banner".
     *
     * @param string $uuid Identifikasi unik (UUID) data yang akan dihapus.
     * @return void
     */
    public function aksi_hapus_data(string $uuid): void
    {
        // Menghapus data banner menggunakan model "Banner_model"
        $result = $this->model('Banner_model')->deleteData($uuid);

        // Memeriksa apakah penghapusan data berhasil (result > 0)
        if ($result > 0) {
            // Menampilkan pesan sukses dan arahkan kembali ke halaman "Banner"
            Flasher::setFlash('Data Banner <strong>Berhasil</strong> dihapus', 'success');
            header('Location: ' . BASEURL . '/banner');
            exit;
        } else {
            // Jika ada kesalahan, tampilkan pesan kesalahan dan arahkan kembali ke halaman "Banner"
            Flasher::setFlash('Data Banner <strong>Gagal</strong> dihapus', 'danger');
            header('Location: ' . BASEURL . '/banner');
            exit;
        }
    }
}
