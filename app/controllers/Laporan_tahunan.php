<?php

class Laporan_tahunan extends Controller
{

    /**
     * Constructor: Mengecek level pengguna dan mengarahkan sesuai akses.
     * 
     * Jika level pengguna adalah '2' (level tertentu), maka pengguna akan diarahkan kembali ke halaman utama.
     * 
     * @return void
     */
    public function __construct()
    {
        // Cek apakah level pengguna adalah '2'
        if ($_SESSION['level'] === '2') {
            // Jika level pengguna adalah '2', arahkan kembali ke halaman utama
            header('Location: ' . BASEURL . '/');
            exit; // Keluar dari skrip setelah mengalihkan halaman
        }
    }

    /**
     * Menampilkan halaman laporan tahunan.
     * 
     * @return void
     */
    public function index(): void
    {
        // Data yang akan digunakan dalam tampilan
        $data = [
            "judul" => "Laporan Tahunan",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "laporan" => $this->model('Laporan_model')->getData()
        ];

        // Menambahkan script tambahan ke dalam data script
        $data["script"] += ["util" => "js/util/script.js"];

        // Memuat tampilan untuk sidebar, konten laporan tahunan, dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('laporan_tahunan/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * -------------------------------------------------------------------------------------------------------------------------
     *                      ACTION METHOD
     * -------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Aksi untuk menambahkan laporan tahunan.
     * 
     * @return void
     */
    public function aksi_tambah_laporan(): void
    {
        // Memanggil model untuk menambahkan data laporan
        $rowCount = $this->model('Laporan_model')->tambahData($_POST);

        // Memeriksa apakah penambahan berhasil
        if ($rowCount > 0 && is_int($rowCount)) {
            // Jika berhasil, set pesan flash success dan arahkan ke halaman laporan tahunan
            Flasher::setFlash('Laporan berhasil ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        } else {
            // Jika gagal, set pesan flash danger dan arahkan kembali ke halaman laporan tahunan
            Flasher::setFlash($rowCount, 'danger');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        }
    }

    /**
     * Aksi untuk menghapus data laporan tahunan berdasarkan UUID.
     * 
     * @param string $uuid UUID laporan yang akan dihapus.
     * @return void
     */
    public function aksi_hapus_data(string $uuid): void
    {
        // Memanggil model untuk menghapus data laporan berdasarkan UUID
        $rowCount = $this->model('Laporan_model')->deleteData($uuid);

        // Memeriksa apakah penghapusan berhasil
        if ($rowCount > 0 && is_int($rowCount)) {
            // Jika berhasil, set pesan flash success dan arahkan ke halaman laporan tahunan
            Flasher::setFlash('Laporan berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        } else {
            // Jika gagal, set pesan flash danger dan arahkan kembali ke halaman laporan tahunan
            Flasher::setFlash('Gagal hapus data', 'danger');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        }
    }
}
