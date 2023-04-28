<?php

class Admin_visimisi extends Controller {

  public function index(): void {
    $data['judul'] = 'Visi Misi';
    $data['visimisi'] = $this->model('Visimisi_model')->getVisiMisi();
    $this->view('dashboard/sidebar', $data);
    $this->view('admin_visimisi/index', $data);
    $this->view('tinymce/tinymce');
    $this->view('dashboard/footer', $data);
  }

  public function change(): void {
    // var_dump($_POST);
    // var_dump($this->model('Admin_latarbelakang_model')->changeLatarBelakang($_POST));
     if( $this->model('Admin_visimisi_model')->changeVisiMisi($_POST) > 0) {
      Flasher::setFlash('Change', 'berhasil', 'success');
      header('Location: ' . BASEURL . '/admin_visimisi');
      exit;
    } else {
      Flasher::setFlash('Change', 'gagal', 'danger');
      header('Location: ' . BASEURL . '/admin_vismisi');
      exit;
    }
  }

}