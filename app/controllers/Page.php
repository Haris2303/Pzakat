<?php

class Page extends Controller {

  public function index() {}

  public function news() {
    $data = [
      "judul" => "Berita",
      "dataBerita" => $this->model('Berita_model')->getAllDataBerita()
    ];
    $this->view('template/header', $data);
    $this->view('page/news', $data);
    $this->view('template/footer', $data);
  }

  public function artikel(): void {
    $data['judul'] = 'Artikel';
    $this->view('template/header', $data);
    $this->view('page/artikel', $data);
    $this->view('template/footer', $data);
  }

}