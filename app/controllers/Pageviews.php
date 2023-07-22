<?php

class Pageviews extends Controller {

  public function index() {

    $data = [
      "judul" => "Berita",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataBerita"  => $this->model('Pageviews_model')->getAllDataBerita(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/index', $data);
    $this->view('dashboard/footer', $data);
    
  }

  public function artikel() {
    $data = [
      "judul" => 'Muzakki',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikel(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/artikel', $data);
    $this->view('dashboard/footer', $data);
  }

  public function detail($slug = true) {

    $data = [
      "judul" => 'Muzakki',
      "css" => VENDOR_TABLES_CSS,
      "dataView" => $this->model('Pageviews_model')->getDataViewBySlug($slug),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    // jika halaman tidak ditemukan
    if(is_bool($data['dataView'])) {
      $this->view('error/404');
      exit;
    }

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/detail', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);
  }
  
  public function upload($jenis_view) {
    
    if($jenis_view !== 'Artikel' && $jenis_view !== 'Berita') {
      $this->view('error/404');
      exit;
    }
    
    $data = [
      "judul" => "Upload Berita",
      "jenis_view" => $jenis_view,
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
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