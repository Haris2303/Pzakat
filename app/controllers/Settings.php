<?php

class Settings extends Controller
{

    /**
     * Redirect ke halaman admin atau amil berdasarkan level pengguna
     * @method index
     */
    public function index(): void
    {
        // Pengecekan level pengguna
        if ($_SESSION['level'] === '1') {
            // Jika level adalah '1' (admin), arahkan ke halaman admin
            header('Location: ' . BASEURL . '/settings/admin');
            exit;
        } else {
            // Jika level bukan '1' (amil), arahkan ke halaman amil
            header('Location: ' . BASEURL . '/settings/amil');
            exit;
        }
    }

    /**
     * Halaman pengaturan akun untuk pengguna level "amil"
     * @method amil
     */
    public function amil(): void
    {
        // Memeriksa apakah pengguna memiliki level "admin"
        if ($_SESSION['level'] === '1') {
            // Jika level adalah '1' (admin), arahkan ke halaman admin
            header('Location: ' . BASEURL . '/settings/admin');
            exit;
        }

        // Mengambil data akun amil berdasarkan username yang disimpan di sesi
        $data = [
            "judul" => "Pengaturan Akun",
            "dataAmil" => $this->model('Amil_model')->getDataAmilByUsername($_SESSION['username'])
        ];

        // Memuat view sidebar, halaman pengaturan akun (settings/index), dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('settings/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Halaman pengaturan akun untuk pengguna level "admin"
     * @method admin
     */
    public function admin(): void
    {
        // Memeriksa apakah pengguna memiliki level "amil" (level '2')
        if ($_SESSION['level'] === '2') {
            // Jika level adalah '2' (amil), arahkan ke halaman amil
            header('Location: ' . BASEURL . '/settings/amil');
            exit;
        }

        // Mengambil data akun "admin" berdasarkan username yang disimpan di sesi
        $data = [
            "judul" => "Pengaturan Akun",
            "dataAmil" => $this->model('Useradmin_model')->getDataByUsername($_SESSION['username'])
        ];

        // Memuat view sidebar, halaman pengaturan akun (settings/index), dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('settings/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Aksi untuk mengubah password pengguna
     * @method aksi_ubah_password
     * @param empty
     */
    public function aksi_ubah_password(): void
    {
        // Menggunakan model User_model untuk mengubah password
        $result = $this->model('User_model')->updatePassword($_SESSION['username'], $_POST);

        // Memeriksa hasil update password
        if ($result > 0 && is_int($result)) {
            // Jika update berhasil, set pesan flash sukses dan arahkan ke halaman pengaturan
            Flasher::setFlash('Password <strong>Berhasil</strong> Diubah!', 'success');
            header('Location: ' . BASEURL . '/settings');
            exit;
        } else {
            // Jika update gagal, set pesan flash dengan pesan hasil dari model (kesalahan) dan arahkan kembali ke halaman pengaturan
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/settings');
            exit;
        }
    }
}
