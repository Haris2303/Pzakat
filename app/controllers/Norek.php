<?php

class Norek extends Controller
{

    public function __construct()
    {
        // jika yang akses bukan admin
        if($_SESSION['level'] !== '1') {
            header('Location: ' . BASEURL . '/');
            exit;
        }
    }

    public function index(): void
    {
        $data = [
            "judul" => "Nomor Rekening",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataNorek" => $this->model('Norek_model')->getAllDataNorek(),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllKategoriProgram('aktif'),
            "dataBank"  => $this->model('Norek_model')->getDataBankJsonDecode()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('norek/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function detail($id): void
    {
        $data = [
            "judul" => "Edit Nomor Rekening",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataNorek" => $this->model('Norek_model')->getDataNorekById($id),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('norek/detail', $data);
        $this->view('dashboard/footer', $data);
    }

    public function ubah(): void
    {
        echo json_encode($this->model('Norek_model')->getDataNorekById($_POST['id']));
    }

    public function getRekeningByJenisProgram(): void
    {
        echo json_encode($this->model('Norek_model')->getAllDataNorekByProgram($_POST['jenisProgram']));
    }

    public function aksi_tambah_norek(): void
    {
        $result = $this->model('Norek_model')->tambahDataNorek($_POST, $_FILES);
        if ($result > 0 && is_int($result)) {
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
        if($result > 0 && is_int($result)) {
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> diubah!', 'success');
            header('Location: ' . BASEURL . '/norek');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/norek');
            exit;
        }
    }

    public function aksi_hapus_data(string $uuid): void
    {
        $result = $this->model('Norek_model')->deleteData($uuid);
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
