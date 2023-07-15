<?php

class Profile extends Controller {

    public function index(): void
    {
        $data = [
            "judul" => "Profile Amil",
            "dataProfile" => $this->model('Amil_model')->getDataAmilByUsername($_SESSION['username']),
            "dataMasjid"  => $this->model('Masjid_model')->getDataMasjid()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('profile/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Ubah Profile Amil
     * @method Action
     * @param NULL
     */
    public function aksi_ubah_profil_amil(): void {
        var_dump($_POST);
        $result = $this->model('Profile_model')->ubahProfilAmil($_POST, $_SESSION['username']);
        if($result > 0) {
            Flasher::setFlash('Perubahan <strong>Berhasil</strong> Disimpan!', 'success');
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            Flasher::setFlash('Perubahan <strong>Gagal</strong> Disimpan!', 'danger');
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }

}