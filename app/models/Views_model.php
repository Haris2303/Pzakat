<?php

class Views_model
{

  /**
   * Kelas ini bertanggung jawab atas interaksi dengan tabel 'tb_views' dalam basis data.
   */
  private $table = 'tb_views';

  /**
   * Objek BaseModel yang digunakan untuk operasi basis data pada tabel 'tb_views'.
   */
  private $baseModel;

  /**
   * Aturan pengurutan default untuk hasil query SELECT dari tabel 'tb_views'.
   */
  private $orderby = ["id_views" => "DESC"];

  /**
   * Konstruktor kelas untuk inisialisasi objek BaseModel dengan tabel 'tb_views'.
   */
  public function __construct()
  {
    // Inisialisasi objek BaseModel dengan nama tabel dari variabel $table.
    $this->baseModel = new BaseModel($this->table);
  }


  /**
   * Mengambil seluruh data berita dari basis data.
   *
   * @return array Sebuah array yang berisi seluruh data berita yang diambil dari basis data.
   */
  public function getAllDataBerita(): array
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan seluruh data berita.
    // Data diurutkan berdasarkan pengaturan urutan yang disimpan dalam properti 'orderby'.
    // Hanya data dengan jenis_views 'Berita' yang diambil.
    $this->baseModel->selectData(null, null, $this->orderby, ["jenis_views =" => "Berita"]);

    // Mengambil dan mengembalikan seluruh data berita yang diambil dari basis data.
    return $this->baseModel->fetchAll();
  }

  /**
   * Mengambil seluruh data artikel dari basis data.
   *
   * @return array Sebuah array yang berisi seluruh data artikel yang diambil dari basis data.
   */
  public function getAllDataArtikel(): array
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan seluruh data artikel.
    // Data diurutkan berdasarkan pengaturan urutan yang disimpan dalam properti 'orderby'.
    // Hanya data dengan jenis_views 'Artikel' yang diambil, dan data dengan 'slug' yang tidak mengandung "pilar".
    $this->baseModel->selectData(null, null, $this->orderby, ["logic" => "AND", "jenis_views =" => "Artikel", "slug NOT LIKE" => "%pilar%"]);

    // Mengambil dan mengembalikan seluruh data artikel yang diambil dari basis data.
    return $this->baseModel->fetchAll();
  }

  /**
   * Mengambil data artikel berdasarkan slug dari basis data.
   *
   * @param string $slug Slug dari artikel yang akan diambil.
   * @return array|bool Sebuah array yang berisi data artikel yang diambil dari basis data, atau false jika tidak ditemukan.
   */
  public function getDataViewBySlug($slug): array|bool
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan data artikel berdasarkan slug.
    $this->baseModel->selectData(null, null, [], ["slug =" => $slug]);

    // Mengambil dan mengembalikan data artikel yang diambil dari basis data.
    return $this->baseModel->fetch();
  }

  /**
   * Mengambil seluruh data berita dari basis data dengan batasan jumlah data.
   *
   * @param int $limit Jumlah maksimal data berita yang akan diambil.
   * @return array Sebuah array yang berisi seluruh data berita yang diambil dari basis data.
   */
  public function getAllDataBeritaLimit($limit): array
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan seluruh data berita dengan batasan jumlah.
    // Data diurutkan berdasarkan pengaturan urutan yang disimpan dalam properti 'orderby'.
    // Hanya data dengan jenis_views 'Berita' yang diambil.
    // Jumlah data diambil dibatasi oleh parameter '$limit'.
    $this->baseModel->selectData(null, null, $this->orderby, ["jenis_views =" => "Berita"], "LIMIT " . $limit);

    // Mengambil dan mengembalikan seluruh data berita yang diambil dari basis data.
    return $this->baseModel->fetchAll();
  }

  /**
   * Mengambil seluruh data artikel dari basis data dengan batasan jumlah data.
   *
   * @param int $limit Jumlah maksimal data artikel yang akan diambil.
   * @return array Sebuah array yang berisi seluruh data artikel yang diambil dari basis data.
   */
  public function getAllDataArtikelLimit($limit): array
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan seluruh data artikel dengan batasan jumlah.
    // Data diurutkan berdasarkan pengaturan urutan yang disimpan dalam properti 'orderby'.
    // Hanya data dengan jenis_views 'Artikel' yang diambil, dan data dengan 'slug' yang tidak mengandung "pilar".
    // Jumlah data diambil dibatasi oleh parameter '$limit'.
    $this->baseModel->selectData(null, null, $this->orderby, ["logic" => "AND", "jenis_views =" => "Artikel", "slug NOT LIKE" => "%pilar%"], "LIMIT " . $limit);

    // Mengambil dan mengembalikan seluruh data artikel yang diambil dari basis data.
    return $this->baseModel->fetchAll();
  }

  /**
   * Mengambil data berita berdasarkan kata kunci (keyword) dari basis data.
   *
   * @param string $keyword Kata kunci yang akan digunakan untuk pencarian data berita.
   * @return array Sebuah array yang berisi data berita yang sesuai dengan kata kunci yang diberikan.
   */
  public function getDataBeritaByKeyword(string $keyword): array
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan data berita berdasarkan kata kunci.
    // Data diambil dari view "vwAllBerita".
    // Data diurutkan berdasarkan pengaturan urutan yang disimpan dalam properti 'orderby'.
    // Data akan dicari berdasarkan "slug" atau "judul" yang mengandung kata kunci.
    // Jumlah data diambil dibatasi oleh "LIMIT 3".
    $this->baseModel->selectData("vwAllBerita", null, $this->orderby, ["logic" => "OR", "slug LIKE" => "%$keyword%", "judul LIKE" => "%$keyword%"], "LIMIT 3");

    // Mengambil dan mengembalikan data berita yang sesuai dengan kata kunci yang diberikan.
    return $this->baseModel->fetchAll();
  }

  /**
   * Mengambil data artikel berdasarkan kata kunci (keyword) dari basis data.
   *
   * @param string $keyword Kata kunci yang akan digunakan untuk pencarian data artikel.
   * @return array Sebuah array yang berisi data artikel yang sesuai dengan kata kunci yang diberikan.
   */
  public function getDataArtikelByKeyword(string $keyword): array
  {
    // Melakukan operasi SELECT data dari basis data untuk mendapatkan data artikel berdasarkan kata kunci.
    // Data diambil dari view "vwAllArtikel".
    // Data diurutkan berdasarkan pengaturan urutan yang disimpan dalam properti 'orderby'.
    // Data akan dicari berdasarkan "slug" atau "judul" yang mengandung kata kunci.
    // Jumlah data diambil dibatasi oleh "LIMIT 3".
    $this->baseModel->selectData("vwAllArtikel", null, $this->orderby, ["logic" => "OR", "slug LIKE" => "%$keyword%", "judul LIKE" => "%$keyword%"], "LIMIT 3");

    // Mengambil dan mengembalikan data artikel yang sesuai dengan kata kunci yang diberikan.
    return $this->baseModel->fetchAll();
  }

  /**
   * Menambah data berita ke dalam basis data.
   *
   * @param array $dataPost Data berita yang dikirim melalui formulir.
   * @param array $dataFile Data gambar yang dikirim melalui formulir.
   * @return int|string Jumlah baris yang terpengaruh oleh operasi INSERT atau pesan kesalahan.
   */
  public function tambahBerita($dataPost, $dataFile): int|string
  {
    // Inisialisasi nama file baru ke variabel 'gambar' dengan menggunakan Utility::uploadImage().
    $gambar = Utility::uploadImage($dataFile, 'views');

    // Cek jika gambar gagal terupload.
    if (!is_string($gambar)) {
      return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';
    }

    // Buat slug dari judul.
    $slug = join('-', explode(' ', strtolower($dataPost['judul'])));

    // Siapkan array data yang akan dimasukkan ke dalam basis data.
    $dataArray = array(
      'uuid' => Utility::generateToken(),
      'nama_penulis' => $dataPost['username'],
      'jenis_view' => $dataPost['jenis_view'],
      'judul' => $dataPost['judul'],
      'slug' => $slug,
      'gambar' => $gambar,
      'content' => $dataPost['content']
    );

    // Lakukan operasi INSERT data berita ke dalam basis data.
    $rowCount = $this->baseModel->insertData($dataArray);

    // Kembalikan hasil operasi. Jika jumlah baris terpengaruh lebih dari 0, kembalikan jumlah baris.
    // Jika tidak, kembalikan pesan kesalahan.
    return ($rowCount > 0) ? $rowCount : 'Gagal Upload Berita!';
  }

  /**
   * Mengubah data tampilan (view) berdasarkan data yang diberikan.
   *
   * @param array $dataPost Data yang dikirim melalui formulir.
   * @param array $dataFiles Data gambar yang dikirim melalui formulir.
   * @return int Jumlah baris yang terpengaruh oleh operasi UPDATE.
   */
  public function ubahView($dataPost, $dataFiles): int
  {
    // Inisialisasi variabel-variabel yang diperlukan dari data yang dikirim melalui formulir.
    $slug         = $dataPost['slug'];
    $judul        = $dataPost['judul'];
    $gambarLama   = $dataPost['gambarlama'];
    $gambarBaru   = Utility::uploadImage($dataFiles, 'views');
    $slugbaru     = strtolower(join('-', explode(' ', $judul)));

    // Cek apakah gambar baru berhasil terupload.
    if (!is_string($gambarBaru)) {
      $gambarBaru = $gambarLama;
    } else {
      // Hapus gambar lama jika gambar baru berhasil diupload.
      @unlink('/var/www/html/Pzakat/public/img/views/' . $gambarLama);
    }

    // Siapkan array data yang akan digunakan untuk operasi UPDATE.
    $dataArray = array(
      'nama_penulis' => $dataPost['penulis'],
      'judul' => $judul,
      'slug' => $slugbaru,
      'gambar' => $gambarBaru,
      'content' => $dataPost['content'],
      'datetime' => date('Y-m-d H:i:s')
    );

    // Lakukan operasi UPDATE data tampilan (view) ke dalam basis data.
    return $this->baseModel->updateData($dataArray, ["slug" => $slug]);
  }

  /**
   * Menghapus data tampilan (view) berdasarkan slug yang diberikan.
   *
   * @param string $slug Slug dari data tampilan yang akan dihapus.
   * @return int Jumlah baris yang terpengaruh oleh operasi DELETE.
   */
  public function hapusView($slug): int
  {
    // Hapus gambar lama terkait data tampilan yang akan dihapus.
    // Pertama, ambil nama gambar dari data tampilan yang akan dihapus.
    $this->baseModel->selectData(null, 'gambar', [], ["slug =" => $slug]);
    $getImageName = $this->baseModel->fetch();

    // Hapus gambar lama dari direktori.
    @unlink('/var/www/html/Pzakat/public/img/views/' . $getImageName['gambar']);

    // Lakukan operasi DELETE data tampilan (view) berdasarkan slug.
    return $this->baseModel->deleteData(["slug" => $slug]);
  }
}
