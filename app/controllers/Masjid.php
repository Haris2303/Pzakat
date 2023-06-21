<?php

class Masjid extends Controller
{

  public function index(): void
  {
    $data = [
      "judul" => 'Masjid',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
      ],
      "script" => VENDOR_TABLES,
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view("masjid/index", $data);
    $this->view('dashboard/footer', $data);
  }

  public function ubah(): void
  {
    echo json_encode($this->model('Masjid_model')->getDataMasjidById($_POST['id']));
  }

  // method tambah masjid
  public function aksi_tambah_mesjid(): void {
    $result = $this->model('Masjid_model')->tambahMesjid($_POST);
    if($result > 0) {
      Flasher::setFlash('Data Masjid Berhasil Ditambahkan!', 'success');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    } else {
      Flasher::setFlash('Data Masjid Gagal Ditambahkan!' ,'danger');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    }
  
  }

  // method ubah data masjid
  public function aksi_ubah_mesjid(): void {
    $result = $this->model('Masjid_model')->ubahMesjid($_POST);
    if($result > 0) {
      Flasher::setFlash('Data Masjid Berhasil Diubah!' ,'success');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    } else {
      header("Location: " . BASEURL . '/Masjid');
      Flasher::setFlash('Data Masjid Gagal Diubah', 'danger');
      exit;
    }
  }

  // method hapus data mesjid
  public function aksi_hapus_mesjid($id): void {
    if($this->model('Masjid_model')->hapusMesjid($id) > 0) {
      Flasher::setFlash('Data Masjid Berhasil Dihapus!', 'success');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    } else {
      Flasher::setFlash('Data Masjid Gagal Dihapus', 'danger');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    }
  }

}
