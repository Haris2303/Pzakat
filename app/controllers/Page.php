<?php

class Page extends Controller
{

  /**
   * Halaman 404 Not Found
   * 
   * @method index
   */
  public function index()
  {
    // Set HTTP response code to 404
    http_response_code(404);

    $this->view('error/404');
  }

  /**
   * Halaman berita dengan paginasi
   * 
   * @method news
   * @param int $page - Halaman berita yang ingin ditampilkan (default: 1)
   */
  public function news(int $page = 1)
  {
    // Mengambil data berita
    $data = $this->model('Views_model')->getAllDataBerita();
    // Membuat objek Pagination dengan nama tabel, data, jumlah item per halaman, dan halaman saat ini
    $pagination = new Pagination('tb_views', $data, 10, $page);
    // Mengatur paginasi dengan kondisi tertentu (mengambil data berita)
    $pager = $pagination->setPager(["id_views" => "DESC"], ["jenis_views =" => "Berita"]);
    // Data yang akan dikirimkan ke tampilan (view) halaman berita
    $data = [
      "judul" => "Berita",
      "dataBerita" => $pager
    ];
    // Menampilkan tampilan (view) halaman berita dengan menggunakan data yang telah diatur
    $this->view('template/header', $data);
    $this->view('page/news', $data);
    $this->view('template/footer', $data);
  }

  /**
   * Halaman artikel dengan paginasi
   * 
   * @method artikel
   * @param int $page - Halaman artikel yang ingin ditampilkan (default: 1)
   */
  public function artikel(int $page = 1): void
  {
    // Mengambil data artikel
    $data = $this->model('Views_model')->getAllDataArtikel();
    // Membuat objek Pagination dengan nama tabel, data, jumlah item per halaman, dan halaman saat ini
    $pagination = new Pagination('tb_views', $data, 10, $page);
    // Mengatur paginasi dengan kondisi tertentu (mengambil data artikel)
    $pager = $pagination->setPager(
      ["id_views" => "DESC"],
      [
        "logic" => "AND",
        "jenis_views =" => "Artikel",
        "slug NOT LIKE" => "%pilar%"
      ]
    );
    // Data yang akan dikirimkan ke tampilan (view) halaman artikel
    $data = [
      "judul" => "Artikel",
      "dataArtikel" => $pager
    ];
    // Menampilkan tampilan (view) halaman artikel dengan menggunakan data yang telah diatur
    $this->view('template/header', $data);
    $this->view('page/artikel', $data);
    $this->view('template/footer', $data);
  }
}
