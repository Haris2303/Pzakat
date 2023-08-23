<?php

class Masjid extends Controller
{

  protected $urlMasjid = '/masjid';

  /**
   * Halaman Utama untuk Modul Masjid
   * 
   * @method index
   */
  public function index(): void
  {
    // Menyiapkan data untuk tampilan
    $data = [
      "judul" => 'Masjid',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid(),
    ];

    // Menampilkan tampilan dengan komponen sidebar, konten halaman, dan footer
    $this->view('dashboard/sidebar', $data);
    $this->view('masjid/index', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Mengambil data masjid berdasarkan ID untuk tujuan perubahan
   * 
   * @method ubah
   */
  public function ubah(): void
  {
    // Mendapatkan data masjid berdasarkan ID yang diterima dari POST
    $dataMasjid = $this->model('Masjid_model')->getDataMasjidById($_POST['id']);

    // Mengirimkan data sebagai respons JSON
    echo json_encode($dataMasjid);
  }

  /**
   * Aksi untuk menambahkan data masjid
   * 
   * @method aksi_tambah_mesjid
   */
  public function aksi_tambah_mesjid(): void
  {
    // Memanggil model untuk menambahkan data masjid
    $result = $this->model('Masjid_model')->tambahMesjid($_POST);

    // Pengecekan hasil penambahan data
    if ($result > 0 && is_int($result)) {
      // Jika berhasil ditambahkan
      Flasher::setFlash('Data Masjid Berhasil Ditambahkan!', 'success');
    } else {
      // Jika gagal ditambahkan
      Flasher::setFlash($result, 'danger', 'y');
    }

    // Kembali ke halaman Masjid setelah aksi selesai
    header($this->location . $this->urlMasjid);
    exit;
  }

  /**
   * Aksi untuk mengubah data masjid
   * 
   * @method aksi_ubah_mesjid
   */
  public function aksi_ubah_mesjid(): void
  {
    // Memanggil model untuk mengubah data masjid
    $result = $this->model('Masjid_model')->updateData($_POST);

    // Pengecekan hasil pengubahan data
    if ($result > 0 && is_int($result)) {
      // Jika berhasil diubah
      Flasher::setFlash('Data Masjid Berhasil Diubah!', 'success');
    } else {
      // Jika gagal diubah
      Flasher::setFlash($result, 'danger');
    }

    // Kembali ke halaman Masjid setelah aksi selesai
    header($this->location . $this->urlMasjid);
    exit;
  }

  /**
   * Aksi untuk menghapus data masjid berdasarkan UUID
   * 
   * @method aksi_hapus_data
   * @param string $uuid - UUID dari data masjid yang akan dihapus
   */
  public function aksi_hapus_data(string $uuid): void
  {
    // Memanggil model untuk menghapus data masjid berdasarkan UUID
    $rowCount = $this->model('Masjid_model')->hapusMesjid($uuid);

    // Pengecekan hasil penghapusan data
    if ($rowCount > 0 && is_int($rowCount)) {
      // Jika berhasil dihapus
      Flasher::setFlash('Data Masjid Berhasil Dihapus!', 'success');
    } else {
      // Jika gagal dihapus
      Flasher::setFlash('Data Masjid Gagal Dihapus', 'danger');
    }

    // Kembali ke halaman Masjid setelah aksi selesai
    header($this->location . $this->urlMasjid);
    exit;
  }
}
