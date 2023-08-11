<?php

class Latarbelakang extends Controller
{

  /**
   * Menampilkan halaman latar belakang.
   * 
   * @method index
   */
  public function index(): void
  {
    // Set judul halaman
    $data['judul'] = 'Latar Belakang';

    // Ambil data latar belakang menggunakan model LatarBelakang_model
    $data['latar-belakang'] = $this->model('LatarBelakang_model')->getLatarBelakang();

    // Tampilkan tampilan template dengan header, isi halaman, dan footer
    $this->view('template/header', $data);
    $this->view('latarbelakang/index', $data); // Menampilkan isi halaman
    $this->view('template/footer', $data);
  }
}
