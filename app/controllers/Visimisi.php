<?php

class Visimisi extends Controller {

  public function index() {
    $data['judul'] = 'Visi Misi';
    $data['visimisi'] = $this->model('Visimisi_model')->getVisiMisi();
    $this->view('template/header', $data);
    $this->view('visimisi/index', $data);
    $this->view('template/footer', $data);
  }
  
}