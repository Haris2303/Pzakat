<?php

class View extends Controller {

  public function index($slug = NULL): void {

    $dataView = $this->model('Views_model')->getDataViewBySlug($slug);
    
    // jika halaman tidak ditemukan
    if(is_bool($dataView)) {
      $this->view('error/404');
      exit;
    }

    $data = [
      "dataView" => $dataView
    ];
    $data['judul'] = $data['dataView']['judul'];

    $this->view('template/header', $data);
    $this->view('view/index', $data);
    $this->view('template/footer', $data);

  }

}