<?php

class Profile extends Controller {

    public function index(): void 
    {
        if($_SESSION['level'] === '1') {
            header('Location: ' . BASEURL . '/profile/admin');
            exit;
        } else {
            header('Location: ' . BASEURL . '/profile/amil');
            exit;
        }
    }

    public function amil(): void
    {
        if($_SESSION['level'] === '1') {
            header('Location: ' . BASEURL . '/profile/admin');
            exit;
        }

        $data = [
            "judul" => "Profile Amil",
            "dataProfile" => $this->model('Amil_model')->getDataAmilByUsername($_SESSION['username']),
            "dataMasjid"  => $this->model('Masjid_model')->getDataMasjid()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('profile/amil', $data);
        $this->view('dashboard/footer', $data);
    }

    public function admin(): void
    {
        if($_SESSION['level'] === '2') {
            header('Location: ' . BASEURL . '/profile/amil');
            exit;
        } 

        $data = [
            "judul" => "Profile Admin",
            "admin" => $this->model('Useradmin_model')->getDataByUsername($_SESSION['username']),
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('profile/admin', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Ubah Profile
     * @method Action
     * @param NULL
     */
    public function aksi_ubah_profil_amil(): void {
        $result = $this->model('Profile_model')->ubahProfilAmil($_POST, $_SESSION['username']);
        if($result > 0 && is_int($result)) {
            Flasher::setFlash('Perubahan <strong>Berhasil</strong> Disimpan!', 'success');
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            Flasher::setFlash((is_string($result)) ? $result : "'Perubahan <strong>Gagal</strong> Disimpan!'", 'danger');
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }

    public function aksi_ubah_profil_admin(): void {
        $result = $this->model('Profile_model')->ubahProfilAdmin($_POST, $_SESSION['username']);
        if($result > 0 && is_int($result)) {
            Flasher::setFlash('Perubahan <strong>Berhasil</strong> Disimpan!', 'success');
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            Flasher::setFlash((is_string($result)) ? $result : "'Perubahan <strong>Gagal</strong> Disimpan!'", 'danger');
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }

}