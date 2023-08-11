<?php

class Muzakki extends Controller
{

  /**
   * Halaman index untuk manajemen data Muzakki
   * 
   * @method index
   */
  public function index(): void
  {
    // Mengatur data yang akan dikirimkan ke tampilan (view)
    $data = [
      "judul" => 'Muzakki',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataMuzakki" => $this->model('Muzakki_model')->getAllData(),
    ];

    // Menampilkan tampilan (view) dengan menggunakan data yang telah diatur
    $this->view('dashboard/sidebar', $data);
    $this->view('muzakki/index', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Aksi untuk menghapus data Muzakki berdasarkan ID
   * 
   * @method aksi_hapus_data
   * @param string $id - ID dari data Muzakki yang akan dihapus
   */
  public function aksi_hapus_data(string $id): void
  {
    // Menggunakan model untuk menghapus data Muzakki berdasarkan ID
    $row = $this->model('User_model')->deleteData($id);

    // Pengecekan hasil penghapusan data
    if ($row > 0) {
      // Jika berhasil dihapus
      Flasher::setFlash('Data Muzakki berhasil dihapus', 'success');
    } else {
      // Jika gagal dihapus
      Flasher::setFlash('Data Muzakki gagal dihapus', 'danger');
    }

    // Kembali ke halaman Muzakki setelah aksi selesai
    header('Location: ' . BASEURL . '/muzakki');
    exit;
  }
}
