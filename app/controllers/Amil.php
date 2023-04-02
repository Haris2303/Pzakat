<?php

class Amil extends Controller {

  public function index(): void {
    $data['judul'] = 'Amil';
    $this->view('dashboard/sidebar', $data);
    $this->view('amil/index', $data);
    $this->view('dashboard/footer', $data);
  }

}