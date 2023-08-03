<?php

class Page extends Controller {

  public function index() {
    $this->view('error/404');
  }

  public function news(int $page = 1) {
    $data = $this->model('Pageviews_model')->getAllDataBerita();
    $pagination = new Pagination('tb_views', $data, 10, $page);
    $pager = $pagination->setPager(function() {
      $where = "WHERE jenis_views = 'Berita' ORDER BY id_views DESC";
      return $where;
    });
    $data = [
      "judul" => "Berita",
      "dataBerita" => $pager
    ];
    $this->view('template/header', $data);
    $this->view('page/news', $data);
    $this->view('template/footer', $data);
  }

  public function artikel(int $page = 1): void {
    $data = $this->model('Pageviews_model')->getAllDataArtikel();
    $pagination = new Pagination('tb_views', $data, 10, $page);
    $pager = $pagination->setPager(function() { 
      $where = "WHERE jenis_views = 'Artikel' AND slug NOT LIKE '%Pilar%' ORDER BY id_views DESC";
      return $where;
    });
    $data = [
      "judul" => "Artikel",
      "dataArtikel" => $pager
    ];
    $this->view('template/header', $data);
    $this->view('page/artikel', $data);
    $this->view('template/footer', $data);
  }

}