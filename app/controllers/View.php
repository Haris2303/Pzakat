<?php

class View extends Controller
{

  /**
   * Menampilkan halaman berdasarkan slug
   * @method index
   * @param string|null $slug Slug untuk mengidentifikasi halaman
   */
  public function index($slug = NULL): void
  {
    // Mengambil data konten halaman berdasarkan slug menggunakan model Views_model
    $dataView = $this->model('Views_model')->getDataViewBySlug($slug);

    // Jika halaman tidak ditemukan, tampilkan halaman 404
    if (is_bool($dataView)) {
      $this->view('error/404');
      exit;
    }

    // Mempersiapkan data yang akan ditampilkan di halaman
    $data = [
      "dataView" => $dataView,
      "judul" => $dataView['judul'] // Menetapkan judul halaman dari data konten
    ];

    // Memanggil tampilan untuk menghasilkan halaman
    $this->view('template/header', $data);        // Tampilan header (asumsi)
    $this->view('view/index', $data);             // Tampilan konten utama halaman
    $this->view('template/footer', $data);        // Tampilan footer (asumsi)
  }
}
