<?php

class Useradmin extends Controller {

  public function index(): void {

    $data = [
      "judul" => 'User Admin',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
      ],
      "script" => VENDOR_TABLES,
      "dataAdmin" => $this->model('Useradmin_model')->getAllDataAdmin(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    if($_SESSION['level'] === '1') {
      $this->view('dashboard/sidebar', $data);
      $this->view('useradmin/index', $data);
      $this->view('dashboard/footer', $data);
    } else {
      header('Location: ' . BASEURL . '/');
      exit;
    }
    
  }

  public function aksi_tambah_admin(): void {
    $result = $this->model('Useradmin_model')->addUserAdmin($_POST);
    if($result > 0) {
      Flasher::setFlash('Data Admin Berhasil Ditambahkan', 'success');
      header('Location: ' . BASEURL . '/useradmin');
      exit;
    } else {
      Flasher::setFlash($result ,'danger');
      header('Location: ' . BASEURL . '/useradmin');
      exit;
    }
  }

  public function aksi_tambah_amil(): void {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $result = $this->model('Daftar_model')->daftarUser('Amil', $_POST);
    if($result > 0) {

      // get token
      $token = $this->model('User_model')->getTokenByUsername($username);

      // kirim pesan email untuk aktivasi
      $subject = 'Aktivasi Akun';
      $msg = 'Klik ini berikut untuk aktivasi akun Anda: ' . BASEURL . '/daftar/aktivasi_akun/' . $token;
      $is_email = Utility::sendEmail($email, $subject, $msg);

      if($is_email) {
        Flasher::setFlash('Akun Berhasil Terdaftar Silahkan <strong>Cek Email</strong> untuk <strong>Aktivasi Akun</strong>!', 'info');
        header('Location: ' . BASEURL . '/amil');
        exit;
      }

    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }

}