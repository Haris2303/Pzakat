<?php

class Amil extends Controller
{

  public function index(): void
  {
    $data = [
      "judul" => 'Amil',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataAmil" => $this->model('Amil_model')->getAllData(),
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid(),
    ];

    if($_SESSION['level'] === "1") {
      $this->view('dashboard/sidebar', $data);
      $this->view('amil/index', $data);
      $this->view('dashboard/footer', $data);
    } else {
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  public function detail($username = false): void 
  {
    $data = [
      "judul" => "Detail Amil",
      "css" => VENDOR_TABLES_CSS,
      "detail" => $this->model('Amil_model')->getDataByUsername($username),
      "allMasjid" => $this->model('Masjid_model')->getDataMasjid(),
    ];
    $data['masjid'] = $this->model('Masjid_model')->getDataMasjidById($data['detail']['id_mesjid']);

    if($_SESSION['level'] === "1") {
      $this->view('dashboard/sidebar', $data);
      $this->view('amil/detail', $data);
      $this->view('dashboard/footer', $data);
    } else {
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  /**
   * -----------------------------------------------------------------------------------------------------------------------------------------------------
   *                   ACTION METHOD
   * -----------------------------------------------------------------------------------------------------------------------------------------------------
   */

  // method aksi tambah amil
  public function aksi_tambah_amil(): void {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $result = $this->model('User_model')->createUser('Amil', $_POST);
    if($result > 0 && is_int($result)) {

      // get token
      $token = $this->model('User_model')->getTokenByUsername($username);

      // set href
      $href = BASEURL . '/daftar/aktivasi_akun/' . $token;
      
      // kirim pesan email untuk aktivasi
      $subject = 'Aktivasi Akun';
      $msg = Design::emailMessageActivation($username, $href);
      $is_email = Utility::sendEmail($email, $subject, $msg);

      if($is_email) {
        Flasher::setFlash('Akun Berhasil Terdaftar Silahkan <strong>Cek Email</strong> untuk <strong>Aktivasi Akun</strong>!', 'info', 'y');
        header('Location: ' . BASEURL . '/amil');
        exit;
      }

    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }
  
  // method aksi ubah password amil
  public function aksi_ubah_password(): void 
  {
    $result = $this->model('User_model')->updatePasswordByAdmin($_POST);
    if($result > 0 && is_int($result)) {
      Flasher::setFlash('Data Amil Berhasil Diubah', 'success');
      header('Location: ' . BASEURL . '/amil/detail/' . $_POST['username']);
      exit;
    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/amil/detail/' . $_POST['username']);
      exit;
    }
  }

  // method aksi hapus amil
  public function aksi_hapus_data(string $token): void 
  {
    if($this->model('Amil_model')->deleteAmil($token) > 0) {
      Flasher::setFlash('Data Amil berhasil dihapus', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    } else {
      Flasher::setFlash('Data Amil gagal dihapus', 'danger');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }
}
