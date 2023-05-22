<?php

class Web extends Controller {
  
  public function index(): void {
    $data = [
      "judul" => "Home",
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikel()
    ];
    $this->view('template/header', $data);
    $this->view('web/index', $data);
    $this->view('template/footer', $data);
  }

  public function profil(): void {
    $data['judul'] = 'Profile';
    $this->view('template/header', $data);
    $this->view('web/profil', $data);
    $this->view('template/footer', $data);
  }

}