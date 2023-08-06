<?php

class User_dashboard extends Controller {

    protected $id_user = null;
    protected $data_pending = null;
    protected $data_konfirmasi = null;
    protected $data_sukses = null;
    protected $data_failed = null;
    protected $limit = 5;

    public function __construct()
    {
        // cek status level
        if(!isset($_SESSION['level']) || $_SESSION['level'] !== '3') {
            header('Location: ' . BASEURL . '/');
            exit;
        }

        // get id user
        $this->id_user = $this->model('User_model')->getIdByUsername($_SESSION['username']);

        // set data
        $this->data_pending = $this->model('Kelolapembayaran_model')->getDataPembayaran('pending', 'id_user', $this->id_user);
        $this->data_konfirmasi = $this->model('Kelolapembayaran_model')->getDataPembayaran('konfirmasi', 'id_user', $this->id_user);
        $this->data_failed = $this->model('Kelolapembayaran_model')->getDataPembayaran('failed', 'id_user', $this->id_user);
        $this->data_sukses = $this->model('Kelolapembayaran_model')->getDataPembayaran('success', 'id_user', $this->id_user);
    }

    public function index() {
        $data = [
            'judul' => 'User Dashboard',
            'jumlah_donasi' => count($this->data_sukses),
            'dana' => $this->data_sukses
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/index', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_pending($page = 1) {

        $pagination = new Pagination('vwAllPembayaran', $this->data_pending, $this->limit, $page);

        $paginate = $pagination->setPager(function() {
            $where = "WHERE status_pembayaran = 'pending' AND id_user = $this->id_user ORDER BY tanggal_pembayaran DESC";
            return $where;
        });
        
        $data = [
            'judul' => 'Menunggu Pembayaran',
            'pending' => $paginate,
            'no' => (($page - 1) * $this->limit) + 1
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_pending', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_konfirmasi($page = 1) {
        $pagination = new Pagination('vwAllPembayaran', $this->data_konfirmasi, $this->limit, $page);

        $paginate = $pagination->setPager(function() {
            $where = "WHERE status_pembayaran = 'konfirmasi' AND id_user = $this->id_user ORDER BY tanggal_pembayaran DESC";
            return $where;
        });

        $data = [
            'judul' => 'Konfirmasi Donasi',
            'konfirmasi' => $paginate,
            'no' => (($page - 1) * $this->limit) + 1
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_konfirmasi', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_gagal($page = 1) {
        $pagination = new Pagination('vwAllPembayaran', $this->data_failed, $this->limit, $page);

        $paginate = $pagination->setPager(function() {
            $where = "WHERE status_pembayaran = 'failed' AND id_user = $this->id_user ORDER BY tanggal_pembayaran DESC";
            return $where;
        });

        $data = [
            'judul' => 'Donasi Gagal',
            'gagal' => $paginate,
            'no' => (($page - 1) * $this->limit) + 1
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_gagal', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_sukses($page = 1) {
        $pagination = new Pagination('vwAllPembayaran', $this->data_sukses, $this->limit, $page);

        $paginate = $pagination->setPager(function() {
            $where = "WHERE status_pembayaran = 'success' AND id_user = $this->id_user ORDER BY tanggal_pembayaran DESC";
            return $where;
        });

        $data = [
            'judul' => 'Donasi Sukses',
            'sukses' => $paginate,
            'no' => (($page - 1) * $this->limit) + 1
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_sukses', $data);
        $this->view('template/footer', $data);
    }

    public function pengaturan() {
        $data_user = $this->model('Muzakki_model')->getDataByUsername($_SESSION['username']);

        $data = [
            'judul' => 'Pengaturan Akun',
            'muzakki' => $data_user
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/pengaturan', $data);
        $this->view('template/footer', $data);
    }

    public function detail(string $param = null): void {
        if(!is_null($param)) {
            $this->view('error/404');
            exit;
        }

        $data_detail = $this->model('Kelolapembayaran_model')->getDataPembayaranById($_POST['id_donatur']);
        $data = [
            "judul" => "Detail Pembayaran",
            "detail" => $data_detail
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/detail', $data);
        $this->view('template/footer', $data);
    }

    public function aksi_ubah_profil() {
        $id_user = $this->model('User_model')->getIdByUsername($_SESSION['username']);
        $update = $this->model('Muzakki_model')->ubahProfil($id_user, $_POST);
        if($update > 0) {
            Flasher::setFlash('Perubahan berhasil disimpan!', 'success');
            header('Location: ' . BASEURL . '/user_dashboard/pengaturan');
            exit;
        } else {
            Flasher::setFlash('Perubahan gagal disimpan!', 'danger');
            header('Location: ' . BASEURL . '/user_dashboard/pengaturan');
            exit;
        }
    }

    public function aksi_ubah_password() {
        $update = $this->model('User_model')->ubahPassword($_SESSION['username'], $_POST);
        if($update > 0 && is_int($update)) {
            Flasher::setFlash('Perubahan Password berhasil disimpan!', 'success');
            header('Location: ' . BASEURL . '/user_dashboard/pengaturan');
            exit;
        } else {
            Flasher::setFlash($update, 'danger');
            header('Location: ' . BASEURL . '/user_dashboard/pengaturan');
            exit;
        }
    }

}