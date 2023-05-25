<?php

class Daftar extends Controller {

  // control view index muzakki
  public function index(): void {
    $data['judul'] = "Daftar Muzaqqi";
    $this->view('daftar/index', $data);
  }

  // aksi daftar muzakki
  public function aksi_daftar_muzakki(): void {
    if($this->model('Daftar_model')->daftarMuzakki($_POST) > 0) {
      Flasher::setFlash('Anda Berhasil Terdaftar Silahkan Login!', 'success');
      header('Location: ' . BASEURL . '/login');
      exit;
    } else {
      Flasher::setFlash('Gagal Daftar', 'danger');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    }
  }

}