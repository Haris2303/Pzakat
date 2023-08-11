<?php

class Admin_visimisi extends Controller
{

  /**
   * Metode untuk menampilkan halaman "Visi Misi".
   *
   * @return void
   */
  public function index(): void
  {
    // Data yang akan digunakan dalam tampilan halaman
    $data = [
      "judul" => "Visi Misi",
    ];

    // Mengambil data visi dan misi dari model "Visimisi_model"
    $data['visimisi'] = $this->model('Visimisi_model')->getVisiMisi();

    // Menampilkan view sidebar dengan data yang disertakan
    $this->view('dashboard/sidebar', $data);

    // Menampilkan view halaman "admin_visimisi/index" dengan data yang disertakan
    $this->view('admin_visimisi/index', $data);

    // Menampilkan view "tinymce/tinymce"
    $this->view('tinymce/tinymce');

    // Menampilkan view footer dengan data yang disertakan
    $this->view('dashboard/footer', $data);
  }

  /**
   * Metode untuk mengubah data visi dan misi.
   *
   * @return void
   */
  public function change(): void
  {
    // Menggunakan model "Visimisi_model" untuk mengubah data visi dan misi
    if ($this->model('Visimisi_model')->changeVisiMisi($_POST) > 0) {
      // Jika perubahan berhasil, set pesan flash "success" dan arahkan ke halaman "admin_visimisi"
      Flasher::setFlash('Data Visi Misi Berhasil Diubah', 'success');
      header('Location: ' . BASEURL . '/admin_visimisi');
      exit;
    } else {
      // Jika perubahan gagal, set pesan flash "danger" dan arahkan ke halaman "admin_visimisi"
      Flasher::setFlash('Data Visi Misi Gagal Diubah', 'danger');
      header('Location: ' . BASEURL . '/admin_visimisi');
      exit;
    }
  }
}
