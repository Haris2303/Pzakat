<?php

class Kelola_pembayaran extends Controller
{

  public function index(): void
  {
    $data = [
      "judul" => "Kelola Data Pembayaran",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataPembayaran" => $this->model('Kelolapembayaran_model')->getAllDataPembayaran(),
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi()),
      "countPending" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranPending())
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/index', $data);
    $this->view('dashboard/footer', $data);
  }

  public function detail($id): void
  {
    $data = [
      "judul" => "Detail Pembayaran",
      "css" => VENDOR_TABLES_CSS,
      "detail" => $this->model('Kelolapembayaran_model')->getDataPembayaranById($id)
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/detail', $data);
    $this->view('dashboard/footer', $data);
  }

  public function pending(): void
  {
    $data = [
      "judul" => "Pembayaran Pending",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataPending" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranPending(),
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi()),
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/pending', $data);
    $this->view('dashboard/footer', $data);
  }

  public function konfirmasi(): void
  {
    $data = [
      "judul" => "Pembayaran Konfirmasi",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataKonfirmasi" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranKonfirmasi(),
      "countPending" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranPending())
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/konfirmasi', $data);
    $this->view('dashboard/footer', $data);
  }

  public function success(): void
  {
    $data = [
      "judul" => "Pembayaran Berhasil",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataSukses" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranSukses(),
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi()),
      "countPending" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranPending())
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/success', $data);
    $this->view('dashboard/footer', $data);
  }

  public function failed(): void
  {
    $data = [
      "judul" => "Pembayaran Gagal",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataGagal" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranGagal(),
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi()),
      "countPending" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranPending())
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/failed', $data);
    $this->view('dashboard/footer', $data);
  }

  public function barang(): void
  {
    $data = [
      "judul" => "Kelola Pembayaran Barang",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "namaBarang" => $this->model('Kelolaprogram_model')->getAllDataProgramBarang(),
      "dataBarang" => $this->model('Kelolapembayaran_model')->getAllDataPembayaranBarang()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/barang', $data);
    $this->view('dashboard/footer', $data);
  }

  public function detailbarang($id): void
  {
    $data = [
      "judul" => "Detail Barang",
      "detail" => $this->model('Kelolapembayaran_model')->getDataPembayaranBarangById($id)
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/detailbarang', $data);
    $this->view('dashboard/footer', $data);
  }


  /**
   * 
   * @method aksi
   * 
   */

  public function aksi_konfirmasi_pembayaran(int $id, string $username): void
  {

    /**
     * 
     * @TroubleShooting!!!
     * 
     */

    $dataKonfirmasi = $this->model('Kelolapembayaran_model')->getDataPembayaranById($id);
    $slug         = $dataKonfirmasi['slug_program'];
    $username     = $username;
    $jumlah_dana  = $dataKonfirmasi['jumlah_pembayaran'];
    $nama_bank    = $dataKonfirmasi['nama_bank'];
    var_dump($slug);
    var_dump($dataKonfirmasi);

    // kirim email
    // $subject = "[Lazismu-Unamin] Konfirmasi Donasi Anda Telah Diterima";
    // $body = Utility::mailBody($nama_donatur, $jumlah_dana);
    // $isEmail = Utility::sendEmailKonfirmasi($email_donatur, $subject , $body);

    // // jika email terkirim
    // if ($isEmail) {
    //   $result = $this->model('Kelolapembayaran_model')->konfirmasiPembayaran($slug, $id, $username, $jumlah_dana, $nama_bank);
    //   if ($result > 0) {
    //     Flasher::setFlash('Pembayaran <strong>Berhasil</strong> Dikonfirmasi!', 'success');
    //     header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
    //     exit;
    //   } else {
    //     Flasher::setFlash('Pembayaran <strong>Gagal</strong> Dikonfirmasi!', 'danger');
    //     header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
    //     exit;
    //   }
    // } else {
    //   Flasher::setFlash('Pesan Email <strong>Gagal</strong> Terkirim!', 'danger');
    //   header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
    //   exit;
    // }
  }

  public function aksi_batal_pembayaran($id, $username): void
  {
    $result = $this->model('Kelolapembayaran_model')->batalkanPembayaran($id, $username);
    if ($result > 0) {
      Flasher::setFlash('Pembayaran <strong>Berhasil</strong> Dibatalkan!', 'success');
      header('Location: ' . BASEURL . '/kelola_pembayaran');
      exit;
    } else {
      Flasher::setFlash('Pembayaran <strong>Gagal</strong> Dibatalkan!', 'danger');
      header('Location: ' . BASEURL . '/kelola_pembayaran');
      exit;
    }
  }

  public function aksi_hapus_pembayaran($location, $id): void
  {
    $result = $this->model('Kelolapembayaran_model')->hapusPembayaran($id);
    if ($result > 0) {
      Flasher::setFlash('Pembayaran <strong>Berhasil</strong> Dihapus!', 'success');
      header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
      exit;
    } else {
      Flasher::setFlash('Pembayaran <strong>Gagal</strong> Dihapus!', 'danger');
      header('Location: ' . BASEURL . "/kelola_pembayaran/$location");
      exit;
    }
  }

  /**
   * 
   * @method Aksi pembayaran barang
   * 
   */

  public function aksi_pembayaran_barang(): void
  {
    $result = $this->model('Kelolapembayaran_model')->tambahPembayaranBarang($_POST, $_FILES);
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
