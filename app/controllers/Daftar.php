<?php

class Daftar extends Controller
{

  /**
   * Konstruktor untuk mencegah akses ulang bagi pengguna yang sudah memiliki level akses.
   *
   * Jika sesi dengan level akses sudah diset, maka pengguna akan dialihkan ke halaman utama.
   * Hal ini dilakukan untuk mencegah akses ganda atau akses yang tidak sesuai.
   *
   * @return void
   */
  public function __construct()
  {
    // Memeriksa apakah sesi dengan level akses sudah diset
    if (isset($_SESSION['level'])) {
      // Jika sesi dengan level akses sudah diset, alihkan ke halaman utama
      header('Location: ' . BASEURL . '/');
      exit; // Keluar untuk memastikan kode selanjutnya tidak dieksekusi
    }
  }

  /**
   * Kontrol tampilan halaman indeks (daftar muzakki).
   *
   * Metode ini bertanggung jawab untuk menampilkan halaman indeks (daftar muzakki)
   * dengan mengatur tampilan untuk header, konten halaman, dan footer yang sesuai.
   *
   * @return void
   */
  public function index(): void
  {
    // Data judul halaman
    $data['judul'] = "Daftar Muzaqqi";

    // Tampilkan tampilan (view) header normal
    $this->view('template/normalheader', $data);

    // Tampilkan tampilan (view) konten halaman indeks
    $this->view('daftar/index', $data);

    // Tampilkan tampilan (view) footer normal
    $this->view('template/normalfooter', $data);
  }

  /**
   * --------------------------------------------------------------------------------------------------------------------------
   *              ACTION METHOD
   * --------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * Metode aktivasi akun pengguna berdasarkan token.
   *
   * Metode ini digunakan untuk mengaktifkan akun pengguna berdasarkan token yang diberikan.
   * Pertama, akan dilakukan pemeriksaan apakah token tersebut valid (tersedia dalam database).
   * Jika tidak valid, pengguna akan diarahkan ke halaman login.
   * Jika token valid, metode akan mengaktifkan akun dan memberikan notifikasi sesuai hasil aktivasi.
   *
   * @param string $token Token aktivasi yang diberikan.
   * @return void
   */
  public function aktivasi_akun(string $token): void
  {
    // Mengecek validitas token
    $isToken = $this->model('User_model')->isToken($token);
    if (!$isToken) {
      // Jika token tidak valid, alihkan pengguna ke halaman login
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // Melakukan aktivasi akun berdasarkan token
    $aktivasi = $this->model('User_model')->aktivasiAkun($token);
    if ($aktivasi > 0) {
      // Jika aktivasi berhasil, tampilkan pesan sukses dan arahkan ke halaman login
      Flasher::setFlash('Akun Anda telah diaktivasi. Silahkan login!', 'success');
      header("Location: " . BASEURL . '/login');
      exit;
    } else {
      // Jika aktivasi gagal, tampilkan pesan gagal dan arahkan ke halaman login
      Flasher::setFlash('Akun Anda gagal diaktivasi!', 'danger');
      header("Location: " . BASEURL . '/login');
    }
  }

  /**
   * Metode aksi daftar muzakki (pemberi donasi).
   *
   * Metode ini digunakan untuk memproses pendaftaran muzakki.
   * Data yang dikirimkan melalui form pendaftaran akan disimpan dalam database,
   * dan pengguna akan menerima email aktivasi.
   *
   * @return void
   */
  public function aksi_daftar_muzakki(): void
  {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $result = $this->model('User_model')->createUser('muzakki', $_POST);
    if ($result > 0) {
      // Mendapatkan token untuk aktivasi akun
      $token = $this->model('User_model')->getTokenByUsername($username);

      // Menyiapkan email untuk aktivasi akun
      $subject = 'Aktivasi Akun';
      $href = BASEURL . '/daftar/aktivasi_akun/' . $token;
      $msg = Design::emailMessageActivation($username, $href);

      // Mengirim email aktivasi
      $is_email = Utility::sendEmail($email, $subject, $msg);

      if ($is_email) {
        // Jika email berhasil dikirim, tampilkan pesan sukses dan arahkan ke halaman login
        Flasher::setFlash('Akun Anda Berhasil Terdaftar. Silahkan <strong>Cek Email</strong> untuk <strong>Aktivasi Akun</strong>!', 'info', 'y');
        header('Location: ' . BASEURL . '/login');
        exit;
      }
    } else {
      // Jika pendaftaran gagal, tampilkan pesan gagal dan arahkan kembali ke halaman pendaftaran
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    }
  }
}
