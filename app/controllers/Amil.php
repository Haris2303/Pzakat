<?php

class Amil extends Controller
{

  public function index(): void
  {
    $data = [
      "judul" => 'Amil',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataAmil" => $this->model('Amil_model')->getAllDataAmil(),
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    if($_SESSION['level'] === "1") {
      $this->view('dashboard/sidebar', $data);
      $this->view('amil/index', $data);
      $this->view('dashboard/footer', $data);
    } else {
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }

  public function detail($username = false): void 
  {
    $data = [
      "judul" => "Detail Amil",
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "detail" => $this->model('Amil_model')->getDataAmilByUsername($username),
      "allMasjid" => $this->model('Masjid_model')->getDataMasjid(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $data['masjid'] = $this->model('Masjid_model')->getDataMasjidById($data['detail']['id_mesjid']);

    if($_SESSION['level'] === "1") {
      $this->view('dashboard/sidebar', $data);
      $this->view('amil/detail', $data);
      $this->view('dashboard/footer', $data);
    } else {
      header('Location: ' . BASEURL . '/');
      exit;
    }
  }
  
  // method aksi ubah amil
  public function aksi_ubah_amil(): void 
  {
    $result = $this->model('Amil_model')->ubahAmil($_POST);
    if($result > 0) {
      Flasher::setFlash('Data Amil Berhasil Diubah', 'success');
      header('Location: ' . BASEURL . '/amil/detail/' . $_POST['username']);
      exit;
    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/amil/detail/' . $_POST['username']);
      exit;
    }
  }

  // method aksi hapus amil
  public function aksi_hapus_amil($username): void 
  {
    if($this->model('Amil_model')->hapusAmil($username) > 0) {
      Flasher::setFlash('Data Amil Berhasil Dihapus', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    } else {
      Flasher::setFlash('Data Amil Gagal Diubah', 'danger');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }
}
