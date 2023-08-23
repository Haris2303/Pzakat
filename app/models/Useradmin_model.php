<?php

class Useradmin_model
{

  /**
   * Nama tabel yang digunakan untuk data 'admin'.
   *
   * @var string
   */
  private $table = 'tb_admin';

  /**
   * Nama view yang digunakan untuk melihat semua data 'admin'.
   *
   * @var string
   */
  private $view   = 'vwAllAdmin';

  /**
   * Objek model dasar yang mungkin digunakan untuk operasi database terkait data 'admin'.
   *
   * @var BaseModel
   */
  private $baseModel;

  /**
   * Objek kontroler yang mungkin digunakan dalam operasi terkait data 'admin'.
   *
   * @var Controller
   */
  private $controller;

  /**
   * Konstruktor untuk inisialisasi objek BaseModel dan objek Controller.
   * 
   * Ini akan membuat objek BaseModel yang terhubung dengan tabel 'admin'
   * dan objek Controller yang mungkin digunakan dalam operasi terkait.
   */
  public function __construct()
  {
    // Membuat objek BaseModel yang terhubung dengan tabel 'admin'
    $this->baseModel = new BaseModel($this->table);

    // Membuat objek Controller yang mungkin digunakan dalam operasi terkait.
    $this->controller = new Controller();
  }

  /**
   * ------------------------------------------------------
   *          GET DATA
   * ------------------------------------------------------
   */

  /**
   * Metode untuk mendapatkan semua data admin.
   *
   * @return array Array yang berisi semua data admin.
   */
  public function getAllDataAdmin(): array
  {
    // Melakukan pemilihan (select) data dari view yang sudah didefinisikan sebelumnya
    $this->baseModel->selectData($this->view);

    // Mengambil semua baris data dan mengembalikannya sebagai array
    return $this->baseModel->fetchAll();
  }

  /**
   * Metode untuk mendapatkan data admin berdasarkan username.
   *
   * @param string $username Username dari admin yang ingin dicari.
   * @return array Array yang berisi data admin yang sesuai dengan username yang diberikan.
   */
  public function getDataByUsername($username): array
  {
    // Melakukan pemilihan (select) data dari view yang sudah didefinisikan sebelumnya
    // dengan kondisi bahwa kolom 'username' harus sama dengan nilai $username
    $this->baseModel->selectData($this->view, null, [], ["username =" => $username]);

    // Mengambil satu baris data yang sesuai dengan username dan mengembalikannya sebagai array
    return $this->baseModel->fetch();
  }

  /**
   * Metode untuk menambahkan pengguna admin baru ke dalam sistem.
   *
   * @param array $data Data yang berisi informasi pengguna admin baru.
   * @return int|string Hasil dari operasi penambahan pengguna admin. Jika berhasil, mengembalikan jumlah baris yang ditambahkan, jika gagal, mengembalikan pesan error (string).
   */
  public function addUserAdmin($data)
  {
    // Cek apakah username sudah terdaftar
    if (is_int($this->controller->model('User_model')->getIdByUsername($data['username']))) {
      return 'Username Sudah Ada!';
    }

    // Cek panjang password
    if (strlen($data['password']) < 8) {
      return 'Password Terlalu Lemah!';
    }

    // Konfirmasi password
    if ($data['password'] === $data['passConfirm']) {
      // Insert data user
      $modelUser = new BaseModel('tb_user');
      $modelUser->insertData([
        "username" => $data['username'],
        "password" => password_hash($data['password'], PASSWORD_DEFAULT),
        "waktu_login" => date('Y-m-d H:i:s'),
        "level" => 1,
        "status_aktivasi" => '1'
      ]);

      // Dapatkan ID pengguna
      $id_user = $this->controller->model('User_model')->getIdByUsername($data['username']);

      // Insert data admin
      $rowCount = $this->baseModel->insertData(["id_user" => $id_user, "nama" => htmlspecialchars($data['nama'])]);

      return $rowCount;
    }

    return "Konfirmasi Password Tidak Sama!";
  }

  /**
   * Metode untuk mengubah profil pengguna.
   *
   * @param array  $data     Data yang berisi informasi profil baru.
   * @param string $username Username pengguna yang saat ini digunakan.
   * @return int|string Hasil dari operasi perubahan profil. Jika berhasil, mengembalikan jumlah baris yang diubah, jika gagal, mengembalikan pesan error (string).
   */
  public function ubahProfil(array $data, string $username): int|string
  {
    // Inisialisasi variabel nama dan username baru
    $nama = $data['nama'];
    $username_baru = strtolower($data['username']);

    // Dapatkan ID pengguna berdasarkan username yang saat ini digunakan
    $id_user = $this->controller->model('User_model')->getIdByUsername($username);

    // Perbarui nama pengguna
    $rowCount = $this->baseModel->updateData(["nama" => $nama], ["id_user" => $id_user]);

    // Set session nama baru
    $_SESSION['nama'] = $nama;

    // Jika username diubah
    if ($username_baru !== $username) {
      // Perbarui username
      $rowCount = $this->controller->model('User_model')->updateUsername($id_user, $username_baru);
      if (is_string($rowCount)) {
        return $rowCount; // Mengembalikan pesan error jika perubahan username tidak berhasil
      }
    }

    return $rowCount; // Mengembalikan jumlah baris yang berhasil diubah (profil atau username)
  }
}
