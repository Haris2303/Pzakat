<?php

class Useradmin extends Controller {

  public function index(): void {

    $data = [
      "judul" => 'User Admin',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
      ],
      "script" => VENDOR_TABLES,
      "dataAdmin" => $this->model('Useradmin_model')->getAllDataAdmin(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllKategoriProgram('aktif')
    ];

    if($_SESSION['level'] === '1') {
      $this->view('dashboard/sidebar', $data);
      $this->view('useradmin/index', $data);
      $this->view('dashboard/footer', $data);
    } else {
      header('Location: ' . BASEURL . '/');
      exit;
    }
    
  }

  public function aksi_tambah_admin(): void {
    $result = $this->model('Useradmin_model')->addUserAdmin($_POST);
    if($result > 0) {
      Flasher::setFlash('Data Admin Berhasil Ditambahkan', 'success');
      header('Location: ' . BASEURL . '/useradmin');
      exit;
    } else {
      Flasher::setFlash($result ,'danger');
      header('Location: ' . BASEURL . '/useradmin');
      exit;
    }
  }

}