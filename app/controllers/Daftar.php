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
      Flasher::setFlash('Daftar', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    } else {
      Flasher::setFlash('Daftar', 'Gagal', 'danger');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    }
  }

}