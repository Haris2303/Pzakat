<?php

class Page extends Controller {

  public function index() {
    $this->view('error/404');
  }

  public function news(int $page = 1) {
    $data = $this->model('Views_model')->getAllDataBerita();
    $pagination = new Pagination('tb_views', $data, 10, $page);
    $pager = $pagination->setPager(["id_views" => "DESC"], ["jenis_views =" => "Berita"]);
    $data = [
      "judul" => "Berita",
      "dataBerita" => $pager
    ];
    $this->view('template/header', $data);
    $this->view('page/news', $data);
    $this->view('template/footer', $data);
  }

  public function artikel(int $page = 1): void {
    $data = $this->model('Views_model')->getAllDataArtikel();
    $pagination = new Pagination('tb_views', $data, 10, $page);
    $pager = $pagination->setPager(["id_views" => "DESC"], ["logic" => "AND", "jenis_views =" => "Artikel", "slug NOT LIKE" => "%pilar%"]);
    $data = [
      "judul" => "Artikel",
      "dataArtikel" => $pager
    ];
    $this->view('template/header', $data);
    $this->view('page/artikel', $data);
    $this->view('template/footer', $data);
  }

}