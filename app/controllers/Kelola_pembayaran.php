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

  public function detail($id = true): void
  {
    $data = [
      "judul" => "Detail Pembayaran",
      "css" => VENDOR_TABLES_CSS,
      "detail" => $this->model('Kelolapembayaran_model')->getDataPembayaranById($id)
    ];

    // jika halaman tidak ditemukan
    if(is_bool($data['detail'])) {
      $this->view('error/404');
      exit;
    }

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
      "dataPending" => $this->model("Kelolapembayaran_model")->getDataPembayaran('pending'),
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

  public function detailbarang($id = true): void
  {
    $data = [
      "judul" => "Detail Barang",
      "detail" => $this->model('Kelolapembayaran_model')->getDataPembayaranBarangById($id)
    ];

    // jika halaman tidak ditemukan
    if(is_bool($data['detail'])) {
      $this->view('error/404');
      exit;
    }

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/detailbarang', $data);
    $this->view('dashboard/footer', $data);
  }


  /**
   * 
   * @method aksi
   * 
   */

  public function aksi_konfirmasi_pembayaran(): void
  {

    // get id_donatur on POST
    $id = $_POST['id_donatur'];

    // get data pembayaran by id
    $dataKonfirmasi = $this->model('Kelolapembayaran_model')->getDataPembayaranById($id);

    // initialisasi variabel on datakonfirmasi
    $slug             = $dataKonfirmasi['slug_program'];
    $username         = $_POST['username'];
    $jumlah_dana      = $dataKonfirmasi['jumlah_pembayaran'];
    $nama_bank        = $dataKonfirmasi['nama_bank'];
    $email_donatur    = $dataKonfirmasi['email'];
    $location         = $dataKonfirmasi['status_pembayaran'];

    // kirim email
    $subject = "Konfirmasi Donasi Anda Telah Diterima";
    $message = Design::emailMessageKonfirmasi($id);
    $isEmail = Utility::sendEmail($email_donatur, $subject , $message);

    // jika email terkirim
    if ($isEmail) {
      $result = $this->model('Kelolapembayaran_model')->konfirmasiPembayaran($slug, $id, $username, $jumlah_dana, $nama_bank);
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

  public function aksi_batal_pembayaran(): void
  {

    // get id_donatur on POST
    $id = $_POST['id_donatur'];

    // get data pembayaran by id
    $dataKonfirmasi = $this->model('Kelolapembayaran_model')->getDataPembayaranById($id);

    // initialisasi variabel on datakonfirmasi
    $username         = $_POST['username'];
    $email_donatur    = $dataKonfirmasi['email'];

    // kirim email
    $subject = "Konfirmasi Donasi Anda Gagal";
    $message = Design::emailMessageBatal($id);
    $isEmail = Utility::sendEmail($email_donatur, $subject , $message);

    // jika email terkirim
    if($isEmail) {
      // jalankan model
      $result = $this->model('Kelolapembayaran_model')->batalkanPembayaran($id, $username);
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

  public function aksi_hapus_data(): void
  {
    
    $location = $_POST['pembayaran'];
    $id = $_POST['id'];

    $result = $this->model('Kelolapembayaran_model')->hapusPembayaran($id);
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
