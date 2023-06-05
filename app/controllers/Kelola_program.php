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
            "css" => [
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
                "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function zakat(): void
    {
        $data = [
            "judul" => "Kelola Zakat",
            "css" => [
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
                "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataZakat" => $this->model('Kelolaprogram_model')->getAllDataProgramZakat()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakat', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    public function detail($slug): void
    {
        $data = [
            "judul" => "Kelola Zakat",
            "css" => [
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
                "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataZakat" => $this->model('Kelolaprogram_model')->getDataZakatBySlug($slug)
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
}
