<?php

class Pageviews extends Controller
{

  /**
   * Halaman utama untuk menampilkan data berita.
   * 
   * @method index
   */
  public function index()
  {
    $data = [
      "judul" => "Berita",
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataBerita" => $this->model('Pageviews_model')->getAllDataBerita(),
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/index', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Halaman untuk menampilkan data artikel.
   * 
   * @method artikel
   */
  public function artikel()
  {
    $data = [
      "judul" => 'Artikel',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikel(),
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/artikel', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Halaman detail untuk menampilkan data berdasarkan slug.
   * 
   * @method detail
   * @param string $slug - Slug yang digunakan untuk mengambil data view
   */
  public function detail($slug = true)
  {
    $data = [
      "judul" => 'Detail',
      "css" => VENDOR_TABLES_CSS,
      "dataView" => $this->model('Pageviews_model')->getDataViewBySlug($slug),
    ];

    // Jika halaman tidak ditemukan
    if (is_bool($data['dataView'])) {
      $this->view('error/404');
      exit;
    }

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/detail', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Halaman upload berita atau artikel.
   * 
   * @method upload
   * @param string $jenis_view - Jenis view (Berita atau Artikel) untuk halaman upload
   */
  public function upload($jenis_view)
  {
    if ($jenis_view !== 'Artikel' && $jenis_view !== 'Berita') {
      $this->view('error/404');
      exit;
    }

    $data = [
      "judul" => "Upload $jenis_view",
      "jenis_view" => $jenis_view,
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('pageviews/upload', $data);
    $this->view('tinymce/tinymce', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Aksi untuk menambahkan berita atau artikel.
   * 
   * @method aksi_tambah_berita
   */
  public function aksi_tambah_berita()
  {
    $jenis_view = $_POST['jenis_view'];
    $href = ($jenis_view === 'Berita') ? '/Berita' : '/Artikel';
    $result = $this->model('Pageviews_model')->tambahBerita($_POST, $_FILES);
    if ($result > 0) {
      Flasher::setFlash($jenis_view . ' Berhasil Diupload!', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    }
  }

  /**
   * Aksi untuk mengubah view (berita atau artikel).
   * 
   * @method aksi_ubah_view
   */
  public function aksi_ubah_view()
  {
    $jenis_view = $_POST['jenis_view'];
    $href = ($jenis_view === 'Berita') ? '/Berita' : '/Artikel';
    $result = $this->model('Pageviews_model')->ubahView($_POST, $_FILES);
    if ($result > 0) {
      Flasher::setFlash($jenis_view . ' Berhasil Diupload', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    } else {
      Flasher::setFlash($jenis_view . ' Gagal Diubah!', 'success');
      header('Location: ' . BASEURL . '/pageviews' . $href);
      exit;
    }
  }

  /**
   * Aksi untuk menghapus view berdasarkan slug.
   * 
   * @method aksi_hapus_view
   * @param string $slug - Slug yang digunakan untuk menghapus data view
   */
  public function aksi_hapus_view($slug)
  {
    $dataView = $this->model('Pageviews_model')->getDataViewBySlug($slug);
    $jenis_view = $dataView['jenis_views'];
    $href = ($jenis_view === 'Berita') ? '/Berita' : '/Artikel';
    if ($this->model('Pageviews_model')->hapusView($slug) > 0) {
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
