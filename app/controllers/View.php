<?php

class View extends Controller {

  public function index($slug): void {

    $data = [
      "dataView" => $this->model('Pageviews_model')->getDataViewBySlug($slug),
    ];
    $data['judul'] = $data['dataView']['judul'];

    $this->view('template/header', $data);
    $this->view('view/index', $data);
    $this->view('template/footer', $data);
  }

}