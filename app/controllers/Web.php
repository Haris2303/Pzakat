<?php

class Web extends Controller
{

  /**
   * Menampilkan halaman beranda (home)
   * @method index
   */
  public function index(): void
  {
    // Data yang akan digunakan dalam tampilan halaman beranda
    $data = [
      "judul" => "Home", // Judul halaman beranda
      "donaturTerdaftar" => $this->model('Pembayaran_model')->getDonaturTerdaftar(),
      "dataBerita"  => $this->model('Views_model')->getAllDataBeritaLimit(3),
      "dataArtikel" => $this->model('Views_model')->getAllDataArtikelLimit(4),
      "dataBanner" => $this->model('Banner_model')->getAllDataBanner(),
      "programNameAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif'),
      "dataZakat" => $this->model('Program_model')->getDataProgramZakatLimit(1),
      "jumlahProgram" => count($this->model('Program_model')->getAllDataProgramAktifTunai()),
      "danaTerkumpul" => $this->model('Pembayaran_model')->getDataPemasukkanHarian(),
      "src_video" => $this->model('Video_model')->getData()['link'],
      "laporan" => $this->model('Laporan_model')->getDataLimit(3)
    ];

    // Memanggil tampilan untuk menghasilkan halaman beranda
    $this->view('template/header', $data);         // Tampilan header (asumsi)
    $this->view('web/index', $data);               // Tampilan konten utama halaman beranda
    $this->view('template/footer', $data);         // Tampilan footer (asumsi)
  }

  /**
   * Mengambil data program dengan batasan tertentu (limit) berdasarkan jenis program dari permintaan POST.
   * Fungsi ini mengembalikan hasil dalam format JSON.
   * @method getdataprogram
   * @param empty (Data jenis program diambil dari permintaan POST)
   */
  public function getdataprogram(): void
  {
    // Mengambil data program dengan batasan tertentu berdasarkan jenis program dari permintaan POST
    $jenisProgram = $_POST['name']; // Jenis program diambil dari permintaan POST
    $limit = 3; // Batasan jumlah data program

    // Mengambil data program menggunakan model Program_model
    $dataProgram = $this->model('Program_model')->getDataProgramLimitByJenisProgram($limit, $jenisProgram);

    // Mengirimkan hasil data program dalam format JSON sebagai respons
    echo json_encode($dataProgram);
  }

  /**
   * Mengambil dan menampilkan isi dari template "spinner".
   * Fungsi ini digunakan untuk merender tampilan spinner.
   * @method getTemplate
   * @param empty (Tidak memerlukan argumen)
   */
  public function getTemplate(): void
  {
    // Menampilkan isi template "spinner" menggunakan view() dan menggunakan echo untuk merender output
    echo $this->view('template/spinner');
  }

  /**
   * Melakukan pencarian berdasarkan kata kunci.
   * Fungsi ini mencari data program, berita, dan artikel yang sesuai dengan kata kunci.
   * @method search
   * @param string $keyword Kata kunci yang akan digunakan untuk pencarian.
   */
  public function search(string $keyword = '')
  {
    // Mengganti karakter "-" dengan spasi pada kata kunci
    $replaceKey = str_replace('-', ' ', $keyword);
    // Mencari data program, berita, dan artikel berdasarkan kata kunci
    $data = [
      "program" => $this->model('Program_model')->getDataProgramAktifByKeyword($replaceKey),
      "berita" => $this->model('Views_model')->getDataBeritaByKeyword($replaceKey),
      "artikel" => $this->model('Views_model')->getDataArtikelByKeyword($replaceKey)
    ];
    // Merender tampilan pencarian dengan hasil data yang ditemukan
    $this->view('template/search', $data);
  }
}
