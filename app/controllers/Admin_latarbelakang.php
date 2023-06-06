<?php

class Admin_latarbelakang extends Controller {

  public function index(): void {
    $data = [
      "judul" => "View Latar Belakang",
      "css" => [
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ],
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $data['latar-belakang'] = $this->model('LatarBelakang_model')->getLatarBelakang();
    $this->view('dashboard/sidebar', $data);
    $this->view('admin_latarbelakang/index', $data);
    $this->view('tinymce/tinymce');
    $this->view('dashboard/footer', $data);
  }

  public function change(): void {
    // var_dump($_POST);
    // var_dump($this->model('Admin_latarbelakang_model')->changeLatarBelakang($_POST));
     if( $this->model('Admin_latarbelakang_model')->changeLatarBelakang($_POST) > 0) {
      Flasher::setFlash('Data Latar Belakang Berhasil Diubah', 'success');
      header('Location: ' . BASEURL . '/admin_latarbelakang');
      exit;
    } else {
      Flasher::setFlash('Data Latar Belakang Gagal Diubah', 'danger');
      header('Location: ' . BASEURL . '/admin_latarbelakang');
      exit;
    }
  }

}