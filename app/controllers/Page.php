<?php

class Page extends Controller {

  public function index() {
    $this->view('error/404');
  }

  public function news() {
    $data = [
      "judul" => "Berita",
      "dataBerita" => $this->model('Pageviews_model')->getAllDataBerita()
    ];
    $this->view('template/header', $data);
    $this->view('page/news', $data);
    $this->view('template/footer', $data);
  }

  public function artikel(): void {
    $data = [
      "judul" => "Artikel",
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikel()
    ];
    $this->view('template/header', $data);
    $this->view('page/artikel', $data);
    $this->view('template/footer', $data);
  }

}