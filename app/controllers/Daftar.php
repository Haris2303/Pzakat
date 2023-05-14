<?php

class Daftar extends Controller {

  // control view index muzakki
  public function index(): void {
    $data['judul'] = "Daftar Muzaqqi";
    $this->view('daftar/index', $data);
  }

  // control view amil
  public function amil(): void {
    $data['judul'] = "Daftar Amil";
    $data['masjid'] = $this->model('Masjid_model')->getDataMasjid();
    $this->view('daftar/amil', $data);
  }

  // aksi daftar muzakki
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

  // aksi daftar amil
  public function aksi_daftar_amil(): void {
    if($this->model('Daftar_model')->daftarAmil($_POST) > 0) {
      Flasher::setFlash('Daftar', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/daftar/amil');
      exit;
    } else {
      Flasher::setFlash('Daftar', 'Gagal', 'success');
      header('Location: ' . BASEURL . '/daftar/amil');
      exit;
    }
  }

}