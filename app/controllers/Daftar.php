<?php

class Daftar extends Controller {

  public function index(): void {
    $data['judul'] = "Daftar Muzaqqi";
    $this->view('daftar/index', $data);
  }

  public function amil(): void {
    $data['judul'] = "Daftar Amil";
    $this->view('daftar/amil', $data);
  }

  public function aksi_daftar_muzakki(): void {
    if($this->model('Daftar_model')->daftarMuzakki($_POST) > 0) {
      Flasher::setFlash('Daftar', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    } else {
      Flasher::setFlash('Daftar', 'Gagal', 'success');
      header('Location: ' . BASEURL . '/daftar');
      exit;
    }
  }

}