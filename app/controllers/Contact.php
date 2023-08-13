<?php

class Contact extends Controller
{

  /**
   * Menampilkan halaman "Contact Us".
   *
   * @return void
   */
  public function index(): void
  {
    // Inisialisasi data judul halaman
    $data['judul'] = 'Contact Us';

    // Tampilkan tampilan (view) header
    $this->view('template/header', $data);
    // Tampilkan tampilan (view) konten halaman "Contact Us"
    $this->view('contact/index', $data);
    // Tampilkan tampilan (view) footer
    $this->view('template/footer', $data);
  }
}
