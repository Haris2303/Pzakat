<?php

class Perhitunganzakat extends Controller {

  public function index(): void {

    $data['judul'] = 'Perhitungan Zakat';
    $this->view('template/header', $data);
    $this->view('perhitunganzakat/index', $data);
    $this->view('template/footer', $data);

  }

}