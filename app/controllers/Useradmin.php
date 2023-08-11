<?php

class Useradmin extends Controller
{

  /**
   * Menampilkan halaman dashboard untuk User Admin
   * @method index
   */
  public function index(): void
  {
    // Data yang akan digunakan dalam halaman dashboard
    $data = [
      "judul" => 'User Admin',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
      ],
      "script" => VENDOR_TABLES,
      "dataAdmin" => $this->model('Useradmin_model')->getAllDataAdmin(),
    ];

    // Memeriksa level pengguna yang masuk (admin)
    if ($_SESSION['level'] === '1') {
      // Jika level admin, tampilkan halaman dashboard admin
      $this->view('dashboard/sidebar', $data);
      $this->view('useradmin/index', $data);
      $this->view('dashboard/footer', $data);
    } else {
      // Jika bukan level admin, arahkan kembali ke halaman utama
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  /**
   * Menangani aksi penambahan admin oleh User Admin
   * @method aksi_tambah_admin
   */
  public function aksi_tambah_admin(): void
  {
    // Memanggil model untuk menambahkan data admin berdasarkan data yang dikirimkan melalui POST
    $result = $this->model('Useradmin_model')->addUserAdmin($_POST);

    // Menggunakan hasil dari penambahan admin untuk memberikan umpan balik kepada pengguna
    if ($result > 0) {
      // Jika penambahan admin berhasil, tampilkan pesan sukses
      Flasher::setFlash('Data Admin Berhasil Ditambahkan', 'success');
    } else {
      // Jika penambahan admin gagal, tampilkan pesan kesalahan (yang diterima dari model)
      Flasher::setFlash($result, 'danger');
    }

    // Redirect pengguna kembali ke halaman useradmin setelah aksi penambahan selesai (tanpa memperhatikan berhasil atau gagal)
    header('Location: ' . BASEURL . '/useradmin');
    exit;
  }
}
