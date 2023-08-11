<?php

class Programs extends Controller
{

  /**
   * Halaman awal programs index
   * @method index
   */
  public function index(): void
  {
    // Membuat array $data dengan informasi judul, data program, dan data jenis program aktif
    $data = [
      "judul" => "Programs",

      // Mengambil semua data program dengan jenis_pembayaran tidak sama dengan 'barang'
      "dataProgram" => $this->model('Program_model')->getAllData(['jenis_pembayaran <>' => 'barang']),

      // Mengambil semua kategori program yang memiliki status 'aktif'
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    // Memuat view template/header dan meneruskan variabel $data ke view tersebut
    $this->view('template/header', $data);

    // Memuat view programs/index dan meneruskan variabel $data ke view tersebut
    $this->view('programs/index', $data);

    // Memuat view template/footer dan meneruskan variabel $data ke view tersebut
    $this->view('template/footer', $data);
  }

  /**
   * Halaman untuk menampilkan program-program dengan kategori "zakat"
   * @method zakat
   */
  public function zakat(): void
  {
    // Membuat array $data dengan informasi judul, data program zakat, dan data jenis program aktif
    $data = [
      "judul" => "Programs Zakat",

      // Mengambil semua data program dengan jenis_pembayaran tidak sama dengan 'barang' dan nama_kategoriprogram sama dengan 'zakat'
      "dataProgramZakat" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "zakat"]),

      // Mengambil semua kategori program yang memiliki status 'aktif'
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    // Jika tidak ada data program zakat, tampilkan halaman error 404 dan hentikan eksekusi
    if (count($data['dataProgramZakat']) <= 0) {
      $this->view('error/404');
      exit;
    }

    // Memuat view template/header dan meneruskan variabel $data ke view tersebut
    $this->view('template/header', $data);

    // Memuat view programs/zakat dan meneruskan variabel $data ke view tersebut
    $this->view('programs/zakat', $data);

    // Memuat view template/footer dan meneruskan variabel $data ke view tersebut
    $this->view('template/footer', $data);
  }

  /**
   * Halaman untuk menampilkan program-program dengan kategori "infaq"
   * @method infaq
   */
  public function infaq(): void
  {
    // Membuat array $data dengan informasi judul, data program infaq, dan data jenis program aktif
    $data = [
      "judul" => "Programs Infaq",

      // Mengambil semua data program dengan jenis_pembayaran tidak sama dengan 'barang' dan nama_kategoriprogram sama dengan 'infaq'
      "dataProgramInfaq" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "infaq"]),

      // Mengambil semua kategori program yang memiliki status 'aktif'
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    // Jika tidak ada data program infaq, tampilkan halaman error 404 dan hentikan eksekusi
    if (count($data['dataProgramInfaq']) <= 0) {
      $this->view('error/404');
      exit;
    }

    // Memuat view template/header dan meneruskan variabel $data ke view tersebut
    $this->view('template/header', $data);

    // Memuat view programs/infaq dan meneruskan variabel $data ke view tersebut
    $this->view('programs/infaq', $data);

    // Memuat view template/footer dan meneruskan variabel $data ke view tersebut
    $this->view('template/footer', $data);
  }

  /**
   * Halaman untuk menampilkan program-program dengan kategori "qurban"
   * @method qurban
   */
  public function qurban(): void
  {
    // Membuat array $data dengan informasi judul, data program qurban, dan data jenis program aktif
    $data = [
      "judul" => "Programs Qurban",

      // Mengambil semua data program dengan jenis_pembayaran tidak sama dengan 'barang' dan nama_kategoriprogram sama dengan 'qurban'
      "dataProgramQurban" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "qurban"]),

      // Mengambil semua kategori program yang memiliki status 'aktif'
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    // Jika tidak ada data program qurban, tampilkan halaman error 404 dan hentikan eksekusi
    if (count($data['dataProgramQurban']) <= 0) {
      $this->view('error/404');
      exit;
    }

    // Memuat view template/header dan meneruskan variabel $data ke view tersebut
    $this->view('template/header', $data);

    // Memuat view programs/qurban dan meneruskan variabel $data ke view tersebut
    $this->view('programs/qurban', $data);

    // Memuat view template/footer dan meneruskan variabel $data ke view tersebut
    $this->view('template/footer', $data);
  }

  /**
   * Halaman untuk menampilkan program-program dengan kategori "donasi"
   * @method donasi
   */
  public function donasi(): void
  {
    // Membuat array $data dengan informasi judul, data program donasi, dan data jenis program aktif
    $data = [
      "judul" => "Programs Donasi",

      // Mengambil semua data program dengan jenis_pembayaran tidak sama dengan 'barang' dan nama_kategoriprogram sama dengan 'donasi'
      "dataProgramDonasi" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "donasi"]),

      // Mengambil semua kategori program yang memiliki status 'aktif'
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    // Jika tidak ada data program donasi, tampilkan halaman error 404 dan hentikan eksekusi
    if (count($data['dataProgramDonasi']) <= 0) {
      $this->view('error/404');
      exit;
    }

    // Memuat view template/header dan meneruskan variabel $data ke view tersebut
    $this->view('template/header', $data);

    // Memuat view programs/donasi dan meneruskan variabel $data ke view tersebut
    $this->view('programs/donasi', $data);

    // Memuat view template/footer dan meneruskan variabel $data ke view tersebut
    $this->view('template/footer', $data);
  }

  /**
   * Halaman untuk menampilkan program-program dengan kategori "ramadhan"
   * @method ramadhan
   */
  public function ramadhan(): void
  {
    // Membuat array $data dengan informasi judul, data program ramadhan, dan data jenis program aktif
    $data = [
      "judul" => "Programs Ramadhan",

      // Mengambil semua data program dengan jenis_pembayaran tidak sama dengan 'barang' dan nama_kategoriprogram sama dengan 'ramadhan'
      "dataProgramRamadhan" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "ramadhan"]),

      // Mengambil semua kategori program yang memiliki status 'aktif'
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    // Jika tidak ada data program ramadhan, tampilkan halaman error 404 dan hentikan eksekusi
    if (count($data['dataProgramRamadhan']) <= 0) {
      $this->view('error/404');
      exit;
    }

    // Memuat view template/header dan meneruskan variabel $data ke view tersebut
    $this->view('template/header', $data);

    // Memuat view programs/ramadhan dan meneruskan variabel $data ke view tersebut
    $this->view('programs/ramadhan', $data);

    // Memuat view template/footer dan meneruskan variabel $data ke view tersebut
    $this->view('template/footer', $data);
  }
}
