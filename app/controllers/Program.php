<?php

class Program extends Controller {

  public function index() {
    $data['judul'] = 'Program';
    $this->view('template/header', $data);
    $this->view('program/index', $data);
    $this->view('template/footer', $data);
  }

}