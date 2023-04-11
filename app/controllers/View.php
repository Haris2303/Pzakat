<?php

class View extends Controller {

  public function index(): void {

    $data['judul'] = 'Judul Artikel';
    $this->view('template/header', $data);
    $this->view('view/index', $data);
    $this->view('template/footer', $data);
  }

}