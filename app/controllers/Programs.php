<?php

class Programs extends Controller {

  public function index():void 
  {
    $data['judul'] = 'Program';
    $this->view('template/header', $data);
    $this->view('programs/index', $data);
    $this->view('template/footer', $data);
  }

}