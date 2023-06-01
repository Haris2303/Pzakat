<?php

class Norek extends Controller
{

    public function index(): void
    {
        $data = [
            "judul" => "Nomor Rekening",
            "css" => [
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
                "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataNorek" => $this->model('Norek_model')->getAllDataNorek()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('norek/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function detail($id): void
    {
        $data = [
            "judul" => "Edit Nomor Rekening",
            "css" => [
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
                "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataNorek" => $this->model('Norek_model')->getDataNorekById($id)
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('norek/detail', $data);
        $this->view('dashboard/footer', $data);
    }

    public function ubah(): void
    {
        echo json_encode($this->model('Norek_model')->getDataNorekById($_POST['id']));
    }

    public function aksi_tambah_norek(): void
    {
        $result = $this->model('Norek_model')->tambahDataNorek($_POST, $_FILES);
        if ($result > 0) {
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/norek');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/norek');
            exit;
        }
    }

    public function aksi_ubah_norek(): void
    {
        $result = $this->model('Norek_model')->ubahDataNorek($_POST, $_FILES);
        if($result > 0) {
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> diubah!', 'success');
            header('Location: ' . BASEURL . '/norek');
            exit;
        } else {
            Flasher::setFlash('Data Nomor Rekening <strong>Gagal</strong> diubah!', 'danger');
            header('Location: ' . BASEURL . '/norek');
            exit;
        }
    }

    public function aksi_hapus_norek($id): void
    {
        $result = $this->model('Norek_model')->hapusDataNorekById($id);
        if($result > 0){
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> dihapus!', 'success');
            header('Location: ' . BASEURL . '/norek');
            exit;
        } else {
            Flasher::setFlash('Data Nomor Rekening <strong>Gagal</strong> dihapus!', 'danger');
            header('Location: ' . BASEURL . '/norek');
            exit;
        }
    }
}
