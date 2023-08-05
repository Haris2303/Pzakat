<?php

class Settings extends Controller {

    public function index(): void {
        if($_SESSION['level'] === '1') {
            header('Location: ' . BASEURL . '/settings/admin');
            exit;
        } else {
            header('Location: ' . BASEURL . '/settings/amil');
            exit;
        }
    }

    public function amil(): void {
        if($_SESSION['level'] === '1') {
            header('Location: ' . BASEURL . '/settings/admin');
            exit;
        }

        $data = [
            "judul" => "Pengaturan Akun",
            "dataAmil" => $this->model('Amil_model')->getDataAmilByUsername($_SESSION['username'])
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('settings/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function admin(): void {
        if($_SESSION['level'] === '2') {
            header('Location: ' . BASEURL . '/settings/amil');
            exit;
        }

        $data = [
            "judul" => "Pengaturan Akun",
            "dataAmil" => $this->model('Useradmin_model')->getDataByUsername($_SESSION['username'])
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('settings/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Ubah Password
     * @method Action
     * @param empty
     */
    public function aksi_ubah_password(): void {
        $result = $this->model('Settings_model')->ubahPasswordUser($_SESSION['username'], $_POST);
        if($result > 0 && is_int($result)) {
            Flasher::setFlash('Password <strong>Berhasil</strong> Diubah!', 'success');
            header('Location: ' . BASEURL . '/settings');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/settings');
            exit;
        }
    }

}