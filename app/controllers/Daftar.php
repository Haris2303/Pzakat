<?php

class Daftar extends Controller {

  public function __construct()
  {
    if(isset($_SESSION['level'])) {
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  // control view index muzakki
  public function index(): void {
    $data['judul'] = "Daftar Muzaqqi";
    $this->view('template/normalheader', $data);
    $this->view('daftar/index', $data);
    $this->view('template/normalfooter', $data);
  }

  public function aktivasi_akun(string $token): void {
    // cek token
    $isToken = $this->model('User_model')->isToken($token);
    if(!$isToken) { 
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    $aktivasi = $this->model('User_model')->aktivasiAkun($token);
    if($aktivasi > 0) {
      Flasher::setFlash('Akun Anda telah diaktivasi silahkan login!', 'success');
      header("Location: " . BASEURL . '/login');
      exit;
    } else {
      Flasher::setFlash('Akun Anda gagal diaktivasi!', 'danger');
      header("Location: " . BASEURL . '/login');
    }
  }

  // aksi daftar muzakki
  public function aksi_daftar_muzakki(): void {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $result = $this->model('User_model')->createUser('muzakki', $_POST);
    if($result > 0) {
      
      // get token
      $token = $this->model('User_model')->getTokenByUsername($username);

      // kirim pesan email untuk aktivasi
      $subject = 'Aktivasi Akun';
      $href = BASEURL . '/daftar/aktivasi_akun/' . $token;
      $msg = Design::emailMessageActivation($username, $href);
      $is_email = Utility::sendEmail($email, $subject, $msg);

      if($is_email) {
        Flasher::setFlash('Akun Anda Berhasil Terdaftar Silahkan <strong>Cek Email</strong> untuk <strong>Aktivasi Akun</strong>!', 'info', 'y');
        header('Location: ' . BASEURL . '/login');
        exit;
      }

    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    }
  }

}