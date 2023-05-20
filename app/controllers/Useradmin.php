<?php

class Useradmin extends Controller {

  public function index(): void {

    $data = [
      "judul" => 'User Admin',
      "css" => [
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "js/vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataAdmin" => $this->model('Useradmin_model')->getAllDataAdmin()
    ];
    $this->view('dashboard/sidebar', $data);
    $this->view('useradmin/index', $data);
    $this->view('dashboard/footer', $data);
    
  }

  public function aksi_tambah_admin(): void {
    if($this->model('Useradmin_model')->addUserAdmin($_POST) > 0) {
      Flasher::setFlash('Daftar', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/useradmin');
      exit;
    } else {
      Flasher::setFlash('Daftar', 'Gagal', 'success');
      header('Location: ' . BASEURL . '/useradmin');
      exit;
    }
  }

  public function aksi_tambah_amil(): void {
    if($this->model('Daftar_model')->daftarAmil($_POST) > 0) {
      Flasher::setFlash('Daftar', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    } else {
      Flasher::setFlash('Daftar', 'Gagal', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }

}