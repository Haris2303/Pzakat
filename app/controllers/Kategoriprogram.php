<?php

class Kategoriprogram extends Controller
{

    public function index(): void
    {
        $data = [
            "judul" => "Kategori Program",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataKategoriProgram" => $this->model('Kategoriprogram_model')->getAllDataKategoriProgram(),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kategoriprogram/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function aksi_tambah_kategori(): void
    {
        $result = $this->model('Kategoriprogram_model')->tambahDataKategori($_POST);
        if($result > 0) {
            Flasher::setFlash('Data Kategori <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/kategoriprogram');
            exit;
        } else {
            Flasher::setFlash('Data Kategori <strong>Gagal</strong> Ditambahkan!', 'danger');
            header('Location: ' . BASEURL . '/kategoriprogram');
            exit;
        }
    }

    public function aksi_hapus_kategori($id): void
    {
        $result = $this->model('Kategoriprogram_model')->hapusDataKategori($id);
        if($result > 0){
            Flasher::setFlash('Data Kategori <strong>Berhasil</strong> Dihapus!', 'success');
            header('Location: ' . BASEURL . '/kategoriprogram');
            exit;
        } else {
            Flasher::setFlash('Data Kategori <strong>Gagal</strong> Dihapus!', 'danger');
            header('Location: ' . BASEURL . '/kategoriprogram');
            exit;
        }
    }
}
