<?php

class Kelola_program extends Controller
{

    /**
     * 
     * @View Data
     * 
    */

    public function index(): void
    {
        $data = [
            "judul" => "Kelola Programs",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function zakat(): void
    {
        $data = [
            "judul" => "Kelola Zakat",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataZakat" => $this->model('Kelolaprogram_model')->getAllDataProgramZakat()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakat', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    public function infaq(): void
    {
        $data = [
            "judul" => "Kelola Infaq",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataInfaq" => $this->model('Kelolaprogram_model')->getAllDataProgramInfaq(),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/infaq', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    public function detail($slug): void
    {
        $data = [
            "judul" => "Detail Program",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/detail', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }


    /**
     * 
     * @Aksi Data
     * 
    */

    public function aksi_tambah_zakat(): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataZakat($_POST, $_FILES);
        if($result > 0) {
            Flasher::setFlash('Data Zakat <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/kelola_program/zakat');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/kelola_program/zakat');
            exit;
        }
    }

    public function aksi_tambah_infaq(): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataInfaq($_POST, $_FILES);
        if($result > 0) {
            Flasher::setFlash('Data Infaq <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/kelola_program/infaq');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/kelola_program/infaq');
            exit;
        }
    }
}
