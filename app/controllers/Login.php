<?php

class Login extends Controller
{

  /**
   * Constructor untuk mengontrol akses berdasarkan level pengguna.
   * 
   * @method __construct
   */
  public function __construct()
  {
    // Cek apakah level pengguna sudah di-set di session
    if (isset($_SESSION['level'])) {
      // Jika level pengguna sudah di-set, redirect ke halaman utama
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  /**
   * Halaman index untuk login.
   * 
   * @method index
   */
  public function index(): void
  {
    // Set judul halaman
    $data['judul'] = 'Login';

    // Load template bagian header
    $this->view('template/normalheader', $data);

    // Load halaman login
    $this->view('login/index', $data);

    // Load template bagian footer
    $this->view('template/normalfooter', $data);
  }

  /**
   * Halaman Lupa Password
   * 
   * @method lupa_password
   */
  public function lupa_password(): void
  {
    // Set judul halaman
    $data['judul'] = "Lupa Password?";

    // Tampilkan tampilan header normal
    $this->view('template/normalheader', $data);

    // Tampilkan halaman lupa password
    $this->view('login/lupa_password', $data);

    // Tampilkan tampilan footer normal
    $this->view('template/normalfooter', $data);
  }

  /**
   * Halaman Ubah Password
   * 
   * @method ubah_password
   * @param string|null $email - Alamat email untuk validasi
   * @param string|null $token - Token untuk validasi
   */
  public function ubah_password(string $email = NULL, string $token = NULL): void
  {
    // Jika tidak ada email atau token yang disediakan
    if (is_null($email) && is_null($token)) {
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // Cek validitas email
    $isEmailValid = $this->model('Login_model')->checkEmail($email);
    if ($isEmailValid <= 0) {
      Flasher::setFlash('Gagal Ubah Password! Email tidak valid!', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // Cek validitas token
    $isTokenValid = $this->model('Login_model')->checkToken($token);
    if (is_bool($isTokenValid)) {
      Flasher::setFlash('Gagal Ubah Password! Token tidak valid atau telah kadaluarsa', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // Set session email and token
    $_SESSION['email'] = $email;
    $_SESSION['token'] = $token;

    // Set session status ubah password
    $_SESSION['ubah_password'] = true;

    // Jika sesi ubah password telah kadaluarsa
    if (!isset($_SESSION['ubah_password'])) {
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // Menyiapkan data untuk tampilan
    $data['judul'] = "Ubah Password";
    $data['token'] = $token;

    // Menampilkan halaman ubah password
    $this->view('template/normalheader', $data);
    $this->view('login/ubah_password', $data);
    $this->view('template/normalfooter', $data);
  }

  /**
   * --------------------------------------------------------------------------------------------------------------------------------
   *              ACTION METHOD
   * --------------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * Aksi login untuk memproses data login.
   * 
   * @method aksi_login
   */
  public function aksi_login(): void
  {
    // Ambil data dari POST
    $username = $_POST['username'];

    // Lakukan proses login melalui model Login_model
    $result = $this->model('Login_model')->login($_POST);

    // Pengecekan apakah login berhasil dan valid
    if ($result > 0 && is_int($result)) {
      // Jika berhasil, set beberapa informasi session

      // Ambil id user
      $id_User = $this->model('User_model')->getIdByUsername($username);
      // Set session nama
      $_SESSION['nama'] = $this->model('User_model')->getNamaByIdUser($id_User);

      // Redirect sesuai level user
      switch ($_SESSION['level']) {
        case '3':
          // Jika level user adalah 3, arahkan ke user_dashboard
          header('Location: ' . BASEURL . '/user_dashboard');
          break;
        case '2':
          // Jika level user adalah 2, arahkan ke dashboard admin
          header('Location: ' . BASEURL . '/dashboard');
          break;
        default:
          // Jika level user tidak dikenali, arahkan ke halaman awal
          header('Location: ' . BASEURL . '/');
          break;
      }
      exit;
    } else {
      // Jika login gagal, tampilkan pesan error dan arahkan kembali ke halaman login
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }
  }

  /**
   * Aksi Reset Password
   * 
   * @method aksi_reset_password
   */
  public function aksi_reset_password(): void
  {
    // Ambil email dari input form
    $email = $_POST['email'];

    // Check apakah email terdaftar
    $isEmail = $this->model('Login_model')->checkEmail($email);
    if ($isEmail <= 0) {
      Flasher::setFlash('Gagal Lupa Password! Email tidak terdaftar', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // Dapatkan user id
    $user_id = $this->model('Login_model')->getUserId($email);

    // Set session user id
    $_SESSION['user_id'] = $user_id;

    // Generate token, dengan memanggil method static pada class Utility
    $token = Utility::generateToken();

    // Update token di database
    $token = $this->model('Login_model')->updateToken($token, $user_id);

    // Kirim email
    $message = Design::emailMessageForgot($user_id, $email, $token);
    $emailSent = Utility::sendEmail($email, 'Lupa Password', $message);

    if ($emailSent) {
      Flasher::setFlash('Pesan Berhasil terkirim! Silahkan cek email Anda', 'success');
      header('Location: ' . BASEURL . '/login');
      exit;
    }
  }

  /**
   * Aksi Ubah Password
   * 
   * @method aksi_ubah_password
   */
  public function aksi_ubah_password(): void
  {
    // Ambil data dari sesi untuk validasi
    $email = $_SESSION['email'];
    $token = $_SESSION['token'];
    $user_id = $_SESSION['user_id'];

    // Lakukan proses perubahan password
    $result = $this->model('Login_model')->ubahPassword($_POST);

    if ($result > 0 && is_int($result)) {
      // Generate token baru untuk sesi berikutnya
      $newToken = Utility::generateToken();

      // Update token di database
      $isTokenUpdated = $this->model('Login_model')->updateToken($newToken, $user_id);

      if (is_string($isTokenUpdated)) {
        // Bersihkan data sesi terkait dan beri pesan sukses
        unset($_SESSION['ubah_password']);
        unset($_SESSION['email']);
        unset($_SESSION['token']);
        unset($_SESSION['user_id']);

        Flasher::setFlash('Password berhasil diubah! Silahkan login.', 'success');
        header('Location: ' . BASEURL . '/login');
        exit;
      }
    } else {
      // Jika perubahan password gagal, kembalikan ke halaman ubah password dengan pesan error
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/login/ubah_password/' . $email . '/' . $token);
      exit;
    }
  }
}
