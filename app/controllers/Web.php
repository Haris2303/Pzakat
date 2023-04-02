<?php

class Web extends Controller {
  
  public function index() {
    $data['judul'] = 'Home';
    $this->view('template/header', $data);
    $this->view('web/index', $data);
    $this->view('template/footer', $data);
  }

  public function profil() {
    $data['judul'] = 'Profile';
    $this->view('template/header', $data);
    $this->view('web/profil', $data);
    $this->view('template/footer', $data);
  }

}