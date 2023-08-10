<?php

class Laporan_tahunan extends Controller {

    public function __construct()
    {
        if($_SESSION['level'] === '2') {
            header('Location: ' . BASEURL . '/');
            exit;
        }
    }

    public function index(): void {
        $data = [
            "judul" => "Laporan Tahunan",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "laporan" => $this->model('Laporan_model')->getData()
        ];
        $data["script"] += ["util" => "js/util/script.js"];

        $this->view('dashboard/sidebar', $data);
        $this->view('laporan_tahunan/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function aksi_tambah_laporan(): void {
        $rowCount = $this->model('Laporan_model')->tambahData($_POST);
        if($rowCount > 0 && is_int($rowCount)) {
            Flasher::setFlash('Laporan berhasil ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        } else {
            Flasher::setFlash($rowCount, 'danger');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        }
    }

    public function aksi_hapus_data(string $uuid): void {
        $rowCount = $this->model('Laporan_model')->deleteData($uuid);
        if($rowCount > 0 && is_int($rowCount)) {
            Flasher::setFlash('Laporan berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        } else {
            Flasher::setFlash('Gagal hapus data', 'danger');
            header('Location: ' . BASEURL . '/laporan_tahunan');
            exit;
        }
    }

}