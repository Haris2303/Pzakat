<?php

class Pageviews extends Controller {

  public function index() {

    $data = [
      "judul" => "Berita",
      "css"   => [
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "js/vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataBerita"  => $this->model('Pageviews_model')->getAllDataBerita()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/index', $data);
    $this->view('dashboard/footer', $data);
    
  }
  
  public function uploadberita() {
    
    $data = [
      "judul" => "Upload Berita",
      "css" => [
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ]
    ];
    
    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/uploadberita', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);

  }

  public function aksi_tambah_berita() {

    if($this->model('Pageviews_model')->tambahBerita($_POST, $_FILES) > 0) {
      Flasher::setFlash('Upload', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/pageviews/berita');
      exit;
    } else {
      Flasher::setFlash('Upload', 'Gagal', 'danger');
      header('Location: ' . BASEURL . '/pageviews/berita');
      exit;
    }

  }

}