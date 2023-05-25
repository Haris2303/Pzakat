<?php

class Pageviews extends Controller {

  public function index() {

    $data = [
      "judul" => "Berita",
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataBerita"  => $this->model('Pageviews_model')->getAllDataBerita()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/index', $data);
    $this->view('dashboard/footer', $data);
    
  }

  public function artikel() {
    $data = [
      "judul" => 'Muzakki',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikel()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/artikel', $data);
    $this->view('dashboard/footer', $data);
  }

  public function detail($slug) {

    $data = [
      "judul" => 'Muzakki',
      "css" => [
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "dataView" => $this->model('Pageviews_model')->getDataViewBySlug($slug)
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/detail', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);
  }
  
  public function upload($jenis_view) {
    
    $data = [
      "judul" => "Upload Berita",
      "css" => [
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ],
      "jenis_view" => $jenis_view
    ];
    
    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/upload', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);

  }

  public function aksi_tambah_berita() {
    $jenis_view = $_POST['jenis_view'];
    $href = ($jenis_view === 'Berita') ? '/Berita' : '/Artikel';
    $result = $this->model('Pageviews_model')->tambahBerita($_POST, $_FILES);
    if($result > 0) {
      Flasher::setFlash($jenis_view . ' Berhasil Diupload!', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    }

  }

  public function aksi_ubah_view() {
    $jenis_view = $_POST['jenis_view'];
    $href = ($jenis_view === 'Berita') ? '/Berita' : '/Artikel';
    $result = $this->model('Pageviews_model')->ubahView($_POST, $_FILES);
    if($result > 0) {
      Flasher::setFlash($jenis_view . ' Berhasil Diupload', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    } else {
      Flasher::setFlash($jenis_view . ' Gagal Diubah!', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    }
  }

  public function aksi_hapus_view($slug) {
    $dataView = $this->model('Pageviews_model')->getDataViewBySlug($slug);
    $jenis_view = $dataView['jenis_views'];
    $href = ($jenis_view === 'Berita') ? '/Berita' : '/Artikel';
    if($this->model('Pageviews_model')->hapusView($slug) > 0) {
      Flasher::setFlash('Berhasil Dihapus', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    } else {
      Flasher::setFlash('Gagal Dihapus', 'danger');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    }
  }

}