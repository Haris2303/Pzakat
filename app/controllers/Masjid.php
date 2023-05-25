<?php

class Masjid extends Controller
{

  public function index(): void
  {
    $data = [
      "judul" => 'Masjid',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid()
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
    
    if($this->model('Masjid_model')->tambahMesjid($_POST) > 0) {
      Flasher::setFlash('Ditambahkan', 'Berhasil', 'success');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    } else {
      header("Location: " . BASEURL . '/Masjid');
      Flasher::setFlash('Ditambahkan', 'Gagal', 'danger');
      exit;
    }
  
  }

  // method ubah data masjid
  public function aksi_ubah_mesjid(): void {
    if($this->model('Masjid_model')->ubahMesjid($_POST) > 0) {
      Flasher::setFlash('Diubah', 'Berhasil', 'success');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    } else {
      header("Location: " . BASEURL . '/Masjid');
      Flasher::setFlash('Diubah', 'Gagal', 'danger');
      exit;
    }
  }

  // method hapus data mesjid
  public function aksi_hapus_mesjid($id): void {
    if($this->model('Masjid_model')->hapusMesjid($id) > 0) {
      Flasher::setFlash('Dihapus', 'Berhasil', 'success');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    } else {
      Flasher::setFlash('Dihapus', 'Gagal', 'danger');
      header("Location: " . BASEURL . '/Masjid');
      exit;
    }
  }

}
