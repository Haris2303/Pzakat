<?php

class Kategoriprogram extends Controller
{

    /**
     * Menampilkan halaman index untuk mengelola kategori program.
     *
     * @return void
     */
    public function index(): void
    {
        // Mengatur data yang akan digunakan dalam halaman
        $data = [
            "judul" => "Kategori Program",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataKategoriProgram" => $this->model('Kategoriprogram_model')->getAllDataKategoriProgram(),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        // Memuat tampilan sidebar, halaman index kategori program, dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('kategoriprogram/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * ------------------------------------------------------------------------
     *              ACTION METHOD
     * ------------------------------------------------------------------------
     */

    /**
     * Aksi tambah kategori: Menambahkan data kategori baru ke dalam sistem.
     *
     * @return void
     */
    public function aksi_tambah_kategori(): void
    {
        // Mencoba tambahkan data kategori baru dengan menggunakan model Kategoriprogram_model
        $result = $this->model('Kategoriprogram_model')->tambahDataKategori($_POST);

        // Memeriksa hasil dari operasi tambah data
        if ($result > 0) {
            // Jika berhasil, menampilkan pesan sukses, kemudian kembali ke halaman kategoriprogram
            Flasher::setFlash('Data Kategori <strong>Berhasil</strong> Ditambahkan!', 'success');
        } else {
            // Jika gagal, menampilkan pesan gagal, kemudian kembali ke halaman kategoriprogram
            Flasher::setFlash('Data Kategori <strong>Gagal</strong> Ditambahkan!', 'danger');
        }

        header($this->location . '/kategoriprogram');
        exit;
    }

    /**
     * Aksi hapus kategori: Menghapus data kategori berdasarkan ID.
     *
     * @param int $id ID kategori yang akan dihapus.
     * @return void
     */
    public function aksi_hapus_kategori($id): void
    {
        // Mencoba menghapus data kategori berdasarkan ID menggunakan model Kategoriprogram_model
        $result = $this->model('Kategoriprogram_model')->hapusDataKategori($id);

        // Memeriksa hasil dari operasi hapus data
        if ($result > 0) {
            // Jika berhasil, menampilkan pesan sukses, kemudian kembali ke halaman kategoriprogram
            Flasher::setFlash('Data Kategori <strong>Berhasil</strong> Dihapus!', 'success');
        } else {
            // Jika gagal, menampilkan pesan gagal, kemudian kembali ke halaman kategoriprogram
            Flasher::setFlash('Data Kategori <strong>Gagal</strong> Dihapus!', 'danger');
        }

        header($this->location . '/kategoriprogram');
        exit;
    }
}
