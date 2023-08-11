<?php

class Kelola_pembayaran extends Controller
{

  /**
   * Index: Menampilkan halaman kelola data pembayaran.
   *
   * @return void
   */
  public function index(): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Kelola Data Pembayaran",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataPembayaran" => $this->model('Pembayaran_model')->getAllDataPembayaran(),
      "countKonfirmasi" => count($this->model('Pembayaran_model')->getAllDataPembayaran('konfirmasi')),
      "countPending" => count($this->model('Pembayaran_model')->getAllDataPembayaran('pending')),
    ];

    // Menampilkan halaman dengan menggunakan template sidebar, halaman index kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/index', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Detail: Menampilkan halaman detail pembayaran berdasarkan ID.
   *
   * @param mixed $id ID pembayaran yang ingin ditampilkan detailnya.
   * @return void
   */
  public function detail($id = true): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Detail Pembayaran",
      "css" => VENDOR_TABLES_CSS,
      "detail" => $this->model('Pembayaran_model')->getDataPembayaranById($id)
    ];

    // Jika pembayaran dengan ID tertentu tidak ditemukan, tampilkan halaman error 404
    if (is_bool($data['detail'])) {
      $this->view('error/404');
      exit;
    }

    // Menampilkan halaman dengan menggunakan template sidebar, halaman detail kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/detail', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Pending: Menampilkan halaman daftar pembayaran dengan status "pending".
   *
   * @return void
   */
  public function pending(): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Pembayaran Pending",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataPending" => $this->model("Pembayaran_model")->getAllDataPembayaran('pending'),
      "countKonfirmasi" => count($this->model('Pembayaran_model')->getAllDataPembayaran('konfirmasi')),
    ];

    // Menampilkan halaman dengan menggunakan template sidebar, halaman pending kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/pending', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Konfirmasi: Menampilkan halaman daftar pembayaran dengan status "konfirmasi".
   *
   * @return void
   */
  public function konfirmasi(): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Pembayaran Konfirmasi",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataKonfirmasi" => $this->model("Pembayaran_model")->getAllDataPembayaran('konfirmasi'),
      "countPending" => count($this->model('Pembayaran_model')->getAllDataPembayaran('pending'))
    ];

    // Menampilkan halaman dengan menggunakan template sidebar, halaman konfirmasi kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/konfirmasi', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Success: Menampilkan halaman daftar pembayaran dengan status "success".
   *
   * @return void
   */
  public function success(): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Pembayaran Berhasil",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataSukses" => $this->model("Pembayaran_model")->getAllDataPembayaran('success'),
      "countKonfirmasi" => count($this->model('Pembayaran_model')->getAllDataPembayaran('konfirmasi')),
      "countPending" => count($this->model('Pembayaran_model')->getAllDataPembayaran('pending'))
    ];

    // Menampilkan halaman dengan menggunakan template sidebar, halaman success kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/success', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Failed: Menampilkan halaman daftar pembayaran dengan status "failed".
   *
   * @return void
   */
  public function failed(): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Pembayaran Gagal",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataGagal" => $this->model("Pembayaran_model")->getAllDataPembayaran('failed'),
      "countKonfirmasi" => count($this->model('Pembayaran_model')->getAllDataPembayaran('konfirmasi')),
      "countPending" => count($this->model('Pembayaran_model')->getAllDataPembayaran('pending'))
    ];

    // Menampilkan halaman dengan menggunakan template sidebar, halaman failed kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/failed', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Barang: Menampilkan halaman kelola pembayaran barang.
   *
   * @return void
   */
  public function barang(): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Kelola Pembayaran Barang",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "namaBarang" => $this->model('Program_model')->getAllDataProgramBarang(),
      "dataBarang" => $this->model('Donasibarang_model')->getAllDataPembayaranBarang()
    ];

    // Menampilkan halaman dengan menggunakan template sidebar, halaman barang kelola_pembayaran, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/barang', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Detailbarang: Menampilkan halaman detail pembayaran barang berdasarkan ID.
   *
   * @param mixed $id ID pembayaran barang
   * @return void
   */
  public function detailbarang($id = true): void
  {
    // Membuat data yang akan digunakan pada halaman
    $data = [
      "judul" => "Detail Barang",
      "detail" => $this->model('Donasibarang_model')->getDataPembayaranBarangById($id)
    ];

    // Jika data detail tidak ditemukan, tampilkan halaman 404
    if (is_bool($data['detail'])) {
      $this->view('error/404');
      exit;
    }

    // Menampilkan halaman dengan menggunakan template sidebar, halaman detailbarang, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/detailbarang', $data);
    $this->view('dashboard/footer', $data);
  }


  /**
   * -----------------------------------------------------------------------------------------------------------------------------
   *                ACTION METHOD
   * -----------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * Aksi_konfirmasi_pembayaran: Mengkonfirmasi pembayaran dan mengirimkan pesan email kepada donatur.
   *
   * @return void
   */
  public function aksi_konfirmasi_pembayaran(): void
  {
    // Get id_donatur from POST
    $id = $_POST['id_donatur'];

    // Get data pembayaran by ID
    $dataKonfirmasi = $this->model('Pembayaran_model')->getDataPembayaranById($id);

    // Initialize variables from dataKonfirmasi
    $slug             = $dataKonfirmasi['slug_program'];
    $username         = $_POST['username'];
    $jumlah_dana      = $dataKonfirmasi['jumlah_pembayaran'];
    $nama_bank        = $dataKonfirmasi['nama_bank'];
    $email_donatur    = $dataKonfirmasi['email'];
    $location         = $dataKonfirmasi['status_pembayaran'];

    // Send email to donatur
    $subject = "Konfirmasi Donasi Anda Telah Diterima";
    $message = Design::emailMessageKonfirmasi($id); // Assuming Design::emailMessageKonfirmasi generates the email message
    $isEmail = Utility::sendEmail($email_donatur, $subject, $message);

    // If email is sent successfully
    if ($isEmail) {
      // Confirm the payment in the database
      $result = $this->model('Pembayaran_model')->konfirmasiPembayaran($slug, $id, $username, $jumlah_dana, $nama_bank);
      if ($result > 0) {
        Flasher::setFlash('Pembayaran <strong>Berhasil</strong> Dikonfirmasi!', 'success');
        header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
        exit;
      } else {
        Flasher::setFlash('Pembayaran <strong>Gagal</strong> Dikonfirmasi!', 'danger');
        header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
        exit;
      }
    } else {
      Flasher::setFlash('Pesan Email <strong>Gagal</strong> Terkirim!', 'danger');
      header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
      exit;
    }
  }

  /**
   * Aksi_batal_pembayaran: Membatalkan konfirmasi pembayaran dan mengirimkan pesan email kepada donatur.
   *
   * @return void
   */
  public function aksi_batal_pembayaran(): void
  {
    // Get id_donatur from POST
    $id = $_POST['id_donatur'];

    // Get data pembayaran by ID
    $dataKonfirmasi = $this->model('Pembayaran_model')->getDataPembayaranById($id);

    // Initialize variables from dataKonfirmasi
    $username      = $_POST['username'];
    $email_donatur = $dataKonfirmasi['email'];

    // Send email to donatur
    $subject = "Konfirmasi Donasi Anda Gagal";
    $message = Design::emailMessageBatal($id); // Assuming Design::emailMessageBatal generates the email message
    $isEmail = Utility::sendEmail($email_donatur, $subject, $message);

    // If email is sent successfully
    if ($isEmail) {
      // Execute model
      $result = $this->model('Pembayaran_model')->batalkanPembayaran($id, $username);
      if ($result > 0) {
        Flasher::setFlash('Pembayaran <strong>Berhasil</strong> Dibatalkan!', 'success');
        header('Location: ' . BASEURL . '/kelola_pembayaran/konfirmasi');
        exit;
      } else {
        Flasher::setFlash('Pembayaran <strong>Gagal</strong> Dibatalkan!', 'danger');
        header('Location: ' . BASEURL . '/kelola_pembayaran/konfirmasi');
        exit;
      }
    }
  }

  /**
   * Aksi_hapus_data: Menghapus data pembayaran berdasarkan kode pembayaran.
   *
   * @param string $kode Kode pembayaran yang akan dihapus.
   * @return void
   */
  public function aksi_hapus_data(string $kode): void
  {
    // Create a new instance of BaseModel for accessing the 'tb_pembayaran' table
    $baseModel = new BaseModel('tb_pembayaran');

    // Select the 'status_pembayaran' column for determining the location
    $baseModel->selectData(null, 'status_pembayaran', [], ["nomor_pembayaran =" => $kode]);
    $location = $baseModel->fetch()['status_pembayaran'];

    // Execute the model to delete the payment record
    $result = $this->model('Pembayaran_model')->hapusPembayaran($kode);
    if ($result > 0) {
      Flasher::setFlash('Pembayaran Berhasil Dihapus!', 'success');
      header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
      exit;
    } else {
      Flasher::setFlash('Pembayaran Gagal Dihapus!', 'danger');
      header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
      exit;
    }
  }

  /**
   * Aksi_pembayaran_barang: Menambahkan data pembayaran barang.
   *
   * @return void
   */
  public function aksi_pembayaran_barang(): void
  {
    // Execute the model to add the payment for the barang
    $result = $this->model('Donasibarang_model')->tambahPembayaranBarang($_POST, $_FILES);
    if ($result > 0) {
      Flasher::setFlash('Barang <strong>Berhasil</strong> Ditambahkan!', 'success');
      header('Location: ' . BASEURL . "/kelola_pembayaran/barang");
      exit;
    } else {
      Flasher::setFlash('Barang <strong>Gagal</strong> Ditambahkan!', 'danger');
      header('Location: ' . BASEURL . "/kelola_pembayaran/barang");
      exit;
    }
  }
}
