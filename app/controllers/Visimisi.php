<?php

class Visimisi extends Controller
{
  /**
   * Menampilkan halaman Visi Misi
   * @method index
   */
  public function index()
  {
    // Menetapkan judul halaman
    $data['judul'] = 'Visi Misi';

    // Mengambil data Visi Misi dari model Visimisi_model
    $data['visimisi'] = $this->model('Visimisi_model')->getVisiMisi();

    // Memanggil tampilan untuk menghasilkan halaman
    $this->view('template/header', $data);         // Tampilan header (asumsi)
    $this->view('visimisi/index', $data);          // Tampilan konten utama halaman
    $this->view('template/footer', $data);         // Tampilan footer (asumsi)
  }
}
