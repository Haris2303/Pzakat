<?php

class Berita extends Controller {

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
      "dataBerita"  => $this->model('Berita_model')->getAllDataBerita()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('berita/index', $data);
    $this->view('dashboard/footer', $data);
    
  }
  
  public function upload() {
    
    $data = [
      "judul" => "Upload Berita",
      "css" => [
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ]
    ];
    
    $this->view('dashboard/sidebar', $data);
    $this->view('berita/upload', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);

  }

  public function aksi_tambah_berita() {

    if($this->model('Berita_model')->tambahBerita($_POST, $_FILES) > 0) {
      Flasher::setFlash('Upload', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/berita');
      exit;
    } else {
      Flasher::setFlash('Upload', 'Gagal', 'danger');
      header('Location: ' . BASEURL . '/berita');
      exit;
    }

  }

}