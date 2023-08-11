<?php

class Perhitunganzakat extends Controller
{

  /**
   * Menampilkan halaman perhitungan zakat.
   *
   * @method index
   */
  public function index(): void
  {
    $data['judul'] = 'Perhitungan Zakat';
    $this->view('template/header', $data);
    $this->view('perhitunganzakat/index', $data);
    $this->view('template/footer', $data);
  }
}
