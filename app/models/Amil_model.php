<?php

class Amil_model
{

  /**
   * Nama tabel yang digunakan untuk data 'amil'.
   *
   * @var string
   */
  private $table = 'tb_amil';

  /**
   * Nama view yang digunakan untuk melihat semua data 'amil'.
   *
   * @var string
   */
  private $view  = 'vwAllAmil';

  /**
   * Objek model dasar yang mungkin digunakan untuk operasi database terkait data 'amil'.
   *
   * @var BaseModel
   */
  private $baseModel;

  /**
   * Objek kontroler yang mungkin digunakan dalam operasi terkait data 'amil'.
   *
   * @var Controller
   */
  private $controller;

  /**
   * Konstruktor untuk inisialisasi objek BaseModel dan objek Controller.
   * 
   * Ini akan membuat objek BaseModel yang terhubung dengan tabel 'amil'
   * dan objek Controller yang mungkin digunakan dalam operasi terkait.
   */
  public function __construct()
  {
    // Membuat objek BaseModel yang terhubung dengan tabel 'amil'
    $this->baseModel = new BaseModel($this->table);

    // Membuat objek Controller yang mungkin digunakan dalam operasi terkait.
    $this->controller = new Controller();
  }


  /**
   * ------------------------------------------------------------------
   *                  GET ALL DATA
   * ------------------------------------------------------------------
   */

  /**
   * Mengambil seluruh data yang tersedia.
   *
   * @return array Data yang berisi semua entri yang tersedia.
   */
  public function getAllData(): array
  {
    $this->baseModel->selectData($this->view);
    return $this->baseModel->fetchAll();
  }


  /**
   * -------------------------------------------------------------------
   *                  GET DATA BY
   * -------------------------------------------------------------------
   */

  /**
   * Mengambil data berdasarkan username Amil.
   *
   * @param string $username Username Amil yang akan digunakan untuk mencari data.
   * @return array Data yang cocok dengan username yang diberikan.
   */
  public function getDataByUsername(string $username): array
  {
    $this->baseModel->selectData($this->view, null, [], ["username = " => $username]);
    return $this->baseModel->fetch();
  }

  /**
   * Mengubah profil pengguna berdasarkan data yang diberikan.
   *
   * @param array $data Data baru yang akan digunakan untuk perubahan profil.
   * @param string $username Username pengguna yang profilnya akan diubah.
   * @return int|string Hasil dari operasi perubahan profil. Jika berhasil,
   * mengembalikan jumlah baris yang diubah, jika gagal, mengembalikan pesan error (string).
   */
  public function ubahProfil(array $data, string $username): int|string
  {
    // Merubah username baru ke huruf kecil
    $usernameBaru = strtolower($data['username']);

    // Membuat dataArray dengan data yang dimasukkan
    $dataArray = [
      'id_mesjid' => (int) $data['id_mesjid'],
      'nama' => $data['nama'],
      'email' => $data['email'],
      'nohp' => $data['nohp'],
      'alamat' => $data['alamat']
    ];

    // Mendapatkan id pengguna berdasarkan username
    $idUser = $this->controller->model('User_model')->getIdByUsername($username);

    // Memeriksa apakah email yang dimasukkan sudah ada di dalam database
    if ($this->controller->model('User_model')->isEmail($dataArray['email'], $idUser)) {
      return 'Email sudah terdaftar!';
    }

    // Mengubah data profil
    $rowCount = $this->baseModel->updateData($dataArray, ["id_user" => $idUser]);

    // Mengatur session nama pengguna
    $_SESSION['nama'] = $dataArray['nama'];

    // Jika username diubah, juga melakukan update username
    if ($usernameBaru !== $username) {
      $rowCount = $this->controller->model('User_model')->updateUsername($idUser, $usernameBaru);
      if (is_string($rowCount)) {
        return $rowCount;
      }
    }

    // Mengembalikan hasil dari operasi perubahan profil (jumlah baris yang diubah atau pesan error)
    return $rowCount;
  }
}
