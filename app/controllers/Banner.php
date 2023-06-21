<?php

class Banner extends Controller
{

    public function index(): void
    {
        $data = [
            "judul" => "Banner",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataBanner" => $this->model('Banner_model')->getAllDataBanner(),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('banner/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function aksi_tambah_banner(): void
    {
        $result = $this->model('Banner_model')->tambahDataBanner($_POST, $_FILES);
        if($result > 0) {
            Flasher::setFlash('Data Banner <strong>Berhasil</strong> ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/banner');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/banner');
            exit;
        }
    }

    public function aksi_hapus_banner($id): void
    {
        $result = $this->model('Banner_model')->hapusDataBanner($id);
        if($result > 0) {
            Flasher::setFlash('Data Banner <strong>Berhasil</strong> dihapus', 'success');
            header('Location: ' . BASEURL . '/banner');
            exit;
        } else {
            Flasher::setFlash('Data Banner <strong>Gagal</strong> dihapus', 'danger');
            header('Location: ' . BASEURL . '/banner');
            exit;
        }
    }
}
