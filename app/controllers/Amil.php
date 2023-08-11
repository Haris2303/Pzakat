<?php

class Amil extends Controller
{

  /**
   * Metode untuk menampilkan halaman "Amil".
   *
   * @return void
   */
  public function index(): void
  {
    // Data yang akan digunakan dalam tampilan halaman
    $data = [
      "judul" => 'Amil',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataAmil" => $this->model('Amil_model')->getAllData(),
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid(),
    ];

    // Memeriksa level pengguna yang sedang masuk (berdasarkan session)
    if ($_SESSION['level'] === "1") {
      // Menampilkan view sidebar dengan data yang disertakan
      $this->view('dashboard/sidebar', $data);

      // Menampilkan view halaman "amil/index" dengan data yang disertakan
      $this->view('amil/index', $data);

      // Menampilkan view footer dengan data yang disertakan
      $this->view('dashboard/footer', $data);
    } else {
      // Jika level tidak sesuai, arahkan kembali ke halaman beranda
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  /**
   * Metode untuk menampilkan halaman "Detail Amil".
   *
   * @param string|bool $username Username Amil (opsional, default: false)
   * @return void
   */
  public function detail($username = false): void
  {
    // Data yang akan digunakan dalam tampilan halaman
    $data = [
      "judul" => "Detail Amil",
      "css" => VENDOR_TABLES_CSS,
      "detail" => $this->model('Amil_model')->getDataByUsername($username),
      "allMasjid" => $this->model('Masjid_model')->getDataMasjid(),
    ];

    // Mendapatkan data masjid berdasarkan ID mesjid yang ditemukan dari data detail Amil
    $data['masjid'] = $this->model('Masjid_model')->getDataMasjidById($data['detail']['id_mesjid']);

    // Memeriksa level pengguna yang sedang masuk (berdasarkan session)
    if ($_SESSION['level'] === "1") {
      // Menampilkan view sidebar dengan data yang disertakan
      $this->view('dashboard/sidebar', $data);

      // Menampilkan view halaman "amil/detail" dengan data yang disertakan
      $this->view('amil/detail', $data);

      // Menampilkan view footer dengan data yang disertakan
      $this->view('dashboard/footer', $data);
    } else {
      // Jika level tidak sesuai, arahkan kembali ke halaman beranda
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  /**
   * -----------------------------------------------------------------------------------------------------------------------------------------------------
   *                   ACTION METHOD
   * -----------------------------------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * Metode untuk menangani aksi penambahan data "Amil".
   *
   * @return void
   */
  public function aksi_tambah_amil(): void
  {
    // Mengambil data dari $_POST
    $username = $_POST['username'];
    $email    = $_POST['email'];

    // Membuat pengguna baru ("Amil") menggunakan model "User_model"
    $result = $this->model('User_model')->createUser('Amil', $_POST);

    // Memeriksa apakah pembuatan pengguna berhasil (result > 0 dan berupa integer)
    if ($result > 0 && is_int($result)) {

      // Mendapatkan token untuk aktivasi
      $token = $this->model('User_model')->getTokenByUsername($username);

      // Menyiapkan href untuk aktivasi akun
      $href = BASEURL . '/daftar/aktivasi_akun/' . $token;

      // Mengirim pesan email untuk aktivasi akun
      $subject = 'Aktivasi Akun';
      $msg = Design::emailMessageActivation($username, $href);

      // Mengirim email menggunakan Utility class
      $is_email = Utility::sendEmail($email, $subject, $msg);

      // Jika email berhasil dikirim
      if ($is_email) {
        Flasher::setFlash('Akun Berhasil Terdaftar Silahkan <strong>Cek Email</strong> untuk <strong>Aktivasi Akun</strong>!', 'info', 'y');
        header('Location: ' . BASEURL . '/amil');
        exit;
      }
    } else {
      // Jika ada kesalahan, tampilkan pesan kesalahan
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }

  /**
   * Metode untuk menangani aksi perubahan password "Amil" oleh administrator.
   *
   * @return void
   */
  public function aksi_ubah_password(): void
  {
    // Menggunakan model "User_model" untuk melakukan pembaruan password oleh administrator
    $result = $this->model('User_model')->updatePasswordByAdmin($_POST);

    // Memeriksa apakah pembaruan password berhasil (result > 0 dan berupa integer)
    if ($result > 0 && is_int($result)) {
      // Menampilkan pesan sukses dan mengarahkan kembali ke halaman detail Amil
      Flasher::setFlash('Data Amil Berhasil Diubah', 'success');
      header('Location: ' . BASEURL . '/amil/detail/' . $_POST['username']);
      exit;
    } else {
      // Jika ada kesalahan, tampilkan pesan kesalahan dan arahkan kembali ke halaman detail Amil
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/amil/detail/' . $_POST['username']);
      exit;
    }
  }

  /**
   * Metode untuk menangani aksi penghapusan data "Amil".
   *
   * @param string $token Token yang mengidentifikasi data yang akan dihapus.
   * @return void
   */
  public function aksi_hapus_data(string $token): void
  {
    // Menggunakan model "User_model" untuk menghapus data berdasarkan token
    if ($this->model('User_model')->deleteData($token) > 0) {
      // Jika penghapusan berhasil, tampilkan pesan sukses dan arahkan kembali ke halaman "Amil"
      Flasher::setFlash('Data Amil berhasil dihapus', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    } else {
      // Jika ada kesalahan, tampilkan pesan kesalahan dan arahkan kembali ke halaman "Amil"
      Flasher::setFlash('Data Amil gagal dihapus', 'danger');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }
}
