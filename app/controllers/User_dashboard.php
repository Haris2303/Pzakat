<?php

class User_dashboard extends Controller {

    public function __construct()
    {
        // cek status level
        if(!isset($_SESSION['level']) || $_SESSION['level'] !== '3') {
            header('Location: ' . BASEURL . '/');
            exit;
        }
    }

    public function index() {
        $data = [
            'judul' => 'User Dashboard'
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/index', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_pending() {
        $data = [
            'judul' => 'Menunggu Pembayaran'
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_pending', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_konfirmasi() {
        $data = [
            'judul' => 'Konfirmasi Donasi'
        ];

        $this->view('template/header', $data);
        $this->view('template/user_sidebar', $data);
        $this->view('user_dashboard/donasi_konfirmasi', $data);
        $this->view('template/footer', $data);
    }

    public function donasi_sukses() {
        $data = [
            'judul' => 'Donasi Sukses'
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