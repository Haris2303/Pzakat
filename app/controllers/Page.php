<?php

class Page extends Controller {

  public function index() {}

  public function artikel(): void {
    $data['judul'] = 'Artikel';
    $this->view('template/header', $data);
    $this->view('page/artikel', $data);
    $this->view('template/footer', $data);
  }

}