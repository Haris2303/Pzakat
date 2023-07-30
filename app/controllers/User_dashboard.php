<?php

class User_dashboard extends Controller {

    protected $id_user = null;
    protected $data_pending = null;
    protected $data_konfirmasi = null;
    protected $data_sukses = null;

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

    public function donasi_pending() {
        $data = [
            'judul' => 'Menunggu Pembayaran',
            'pending' => $this->data_pending
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_pending', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_konfirmasi() {
        $data = [
            'judul' => 'Konfirmasi Donasi',
            'konfirmasi' => $this->data_konfirmasi
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_konfirmasi', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_sukses() {
        $data = [
            'judul' => 'Donasi Sukses',
            'sukses' => $this->data_sukses
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_sukses', $data);
        $this->view('template/footer', $data);
    }

    public function pengaturan() {
        $data = [
            'judul' => 'Pengaturan Akun'
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/pengaturan', $data);
        $this->view('template/footer', $data);
    }

}