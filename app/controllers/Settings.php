<?php

class Settings extends Controller {

    public function index(): void {
        $data = [
            "judul" => "Pengaturan Akun",
            "dataAmil" => $this->model('Amil_model')->getDataAmilByUsername($_SESSION['username'])
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('settings/index', $data);
        $this->view('dashboard/footer', $data);
    }

}