<?php

class Admin_latarbelakang extends Controller
{

  /**
   * Menampilkan halaman indeks dengan data latar belakang pengguna dan tampilan terkait.
   */
  public function index(): void
  {
    // Menyiapkan data untuk tampilan, termasuk judul.
    $data = [
      "judul" => "Tampilkan Latar Belakang",
    ];

    // Mengambil data latar belakang pengguna menggunakan model 'LatarBelakang_model'.
    $data['latar-belakang'] = $this->model('LatarBelakang_model')->getLatarBelakang();

    // Memuat berbagai tampilan untuk membangun tata letak halaman.

    // Memuat tampilan sidebar.
    $this->view('dashboard/sidebar', $data);

    // Memuat tampilan indeks utama dengan data latar belakang pengguna.
    $this->view('admin_latarbelakang/index', $data);

    // Memuat tampilan TinyMCE (mungkin untuk penyuntingan teks yang kaya).
    $this->view('tinymce/tinymce');

    // Memuat tampilan footer.
    $this->view('dashboard/footer', $data);
  }


  /**
   * Handles the process of changing user background data.
   */
  public function change(): void
  {
    // Menggunakan model 'LatarBelakang_model' untuk mengubah data latar belakang.
    if ($this->model('LatarBelakang_model')->changeLatarBelakang($_POST) > 0) {
      // Jika perubahan berhasil, set pesan notifikasi sukses, lalu arahkan ke halaman admin latar belakang.
      Flasher::setFlash('Data Latar Belakang Berhasil Diubah', 'success');
      header('Location: ' . BASEURL . '/admin_latarbelakang');
      exit;
    } else {
      // Jika perubahan gagal, set pesan notifikasi gagal, lalu arahkan ke halaman admin latar belakang.
      Flasher::setFlash('Data Latar Belakang Gagal Diubah', 'danger');
      header('Location: ' . BASEURL . '/admin_latarbelakang');
      exit;
    }
  }
}
