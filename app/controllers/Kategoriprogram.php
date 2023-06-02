<?php

class Kategoriprogram extends Controller
{

    public function index(): void
    {
        $data = [
            "judul" => "Kategori Program",
            "css" => [
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
                "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataKategoriProgram" => $this->model('Kategoriprogram_model')->getAllDataKategoriProgram()
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
