<?php

class Profile extends Controller
{

    /**
     * Mengarahkan pengguna ke halaman profile berdasarkan level mereka.
     * Jika level adalah '1' (admin), pengguna akan diarahkan ke halaman profile admin.
     * Jika bukan admin, pengguna akan diarahkan ke halaman profile amil.
     * Setelah pengalihan, eksekusi dihentikan untuk mencegah pemrosesan lebih lanjut.
     */
    public function index(): void
    {
        // Periksa level pengguna
        if ($_SESSION['level'] === '1') {
            // Jika admin, arahkan ke halaman profile admin
            header('Location: ' . BASEURL . '/profile/admin');
            exit;
        } else {
            // Jika bukan admin, arahkan ke halaman profile amil
            header('Location: ' . BASEURL . '/profile/amil');
            exit;
        }
    }

    /**
     * Halaman profil Amil.
     * Jika pengguna adalah admin (level '1'), mereka akan diarahkan ke halaman profil admin.
     * Jika bukan admin, data profil Amil dan data Masjid akan diambil dari model
     * dan ditampilkan dalam tampilan profil Amil.
     */
    public function amil(): void
    {
        // Periksa apakah pengguna adalah admin
        if ($_SESSION['level'] === '1') {
            // Jika admin, arahkan ke halaman profil admin
            header('Location: ' . BASEURL . '/profile/admin');
            exit;
        }

        // Data yang dibutuhkan untuk tampilan profil Amil
        $data = [
            "judul" => "Profile Amil",
            "dataProfile" => $this->model('Amil_model')->getDataByUsername($_SESSION['username']),
            "dataMasjid"  => $this->model('Masjid_model')->getDataMasjid()
        ];

        // Tampilkan tampilan sidebar, halaman profil Amil, dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('profile/amil', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Halaman profil Admin.
     * Jika pengguna adalah amil (level '2'), mereka akan diarahkan ke halaman profil amil.
     * Jika bukan amil, data profil Admin akan diambil dari model
     * dan ditampilkan dalam tampilan profil Admin.
     */
    public function admin(): void
    {
        // Periksa apakah pengguna adalah amil
        if ($_SESSION['level'] === '2') {
            // Jika amil, arahkan ke halaman profil amil
            header('Location: ' . BASEURL . '/profile/amil');
            exit;
        }

        // Data yang dibutuhkan untuk tampilan profil Admin
        $data = [
            "judul" => "Profile Admin",
            "admin" => $this->model('Useradmin_model')->getDataByUsername($_SESSION['username']),
        ];

        // Tampilkan tampilan sidebar, halaman profil Admin, dan footer
        $this->view('dashboard/sidebar', $data);
        $this->view('profile/admin', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Aksi untuk mengubah profil Amil.
     * Metode ini mengambil data yang diubah dari formulir (POST data)
     * dan mengirim perubahan tersebut ke model Amil_model untuk diubah.
     * Setelah perubahan berhasil disimpan, pengguna akan diarahkan kembali ke halaman profil.
     * Jika terjadi kesalahan selama proses perubahan profil, pengguna juga akan diarahkan kembali ke halaman profil
     * dengan pesan kesalahan yang sesuai.
     */
    public function aksi_ubah_profil_amil(): void
    {
        // Mengirim data yang diubah ke model untuk perubahan
        $result = $this->model('Amil_model')->ubahProfil($_POST, $_SESSION['username']);

        // Memeriksa hasil dari perubahan
        if ($result > 0 && is_int($result)) {
            // Jika perubahan berhasil, set pesan sukses dan arahkan kembali ke halaman profil
            Flasher::setFlash('Perubahan <strong>Berhasil</strong> Disimpan!', 'success');
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            // Jika perubahan gagal, set pesan kesalahan dan arahkan kembali ke halaman profil
            Flasher::setFlash((is_string($result)) ? $result : "'Perubahan <strong>Gagal</strong> Disimpan!'", 'danger');
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }

    /**
     * Aksi untuk mengubah profil Admin.
     * Metode ini mengambil data yang diubah dari formulir (POST data)
     * dan mengirim perubahan tersebut ke model Useradmin_model untuk diubah.
     * Setelah perubahan berhasil disimpan, pengguna akan diarahkan kembali ke halaman profil.
     * Jika terjadi kesalahan selama proses perubahan profil, pengguna juga akan diarahkan kembali ke halaman profil
     * dengan pesan kesalahan yang sesuai.
     */
    public function aksi_ubah_profil_admin(): void
    {
        // Mengirim data yang diubah ke model untuk perubahan
        $result = $this->model('Useradmin_model')->ubahProfil($_POST, $_SESSION['username']);

        // Memeriksa hasil dari perubahan
        if ($result > 0 && is_int($result)) {
            // Jika perubahan berhasil, set pesan sukses dan arahkan kembali ke halaman profil
            Flasher::setFlash('Perubahan <strong>Berhasil</strong> Disimpan!', 'success');
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            // Jika perubahan gagal, set pesan kesalahan dan arahkan kembali ke halaman profil
            Flasher::setFlash((is_string($result)) ? $result : "'Perubahan <strong>Gagal</strong> Disimpan!'", 'danger');
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }
}
