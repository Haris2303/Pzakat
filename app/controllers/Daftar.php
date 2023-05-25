<?php

class Daftar extends Controller {

  // control view index muzakki
  public function index(): void {
    $data['judul'] = "Daftar Muzaqqi";
    $this->view('template/normalheader', $data);
    $this->view('daftar/index', $data);
    $this->view('template/normalfooter', $data);
  }

  // aksi daftar muzakki
  public function aksi_daftar_muzakki(): void {
    $result = $this->model('Daftar_model')->daftarMuzakki($_POST);
    if($result > 0) {
      Flasher::setFlash('Anda Berhasil Terdaftar Silahkan Login!', 'success');
      header('Location: ' . BASEURL . '/login');
      exit;
    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    }
  }

}