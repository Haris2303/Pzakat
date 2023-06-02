<?php

class Web extends Controller {
  
  public function index(): void {
    $data = [
      "judul" => "Home",
      "dataBerita"  => $this->model('Pageviews_model')->getAllDataBeritaLimit(3),
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikelLimit(4),
      "dataBanner" => $this->model('Banner_model')->getAllDataBanner()
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