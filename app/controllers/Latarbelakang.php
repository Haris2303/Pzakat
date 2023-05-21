<?php 

class Latarbelakang extends Controller {

  public function index(): void {
    $data['judul'] = 'Latar Belakang';
    $data['latar-belakang'] = $this->model('LatarBelakang_model')->getLatarBelakang();
    $this->view('template/header', $data);
    $this->view('latarbelakang/index', $data);
    $this->view('template/footer', $data);
  }

}