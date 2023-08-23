<?php

class Muzakki_model
{

  private $table = 'tb_muzakki';
  private $view = 'vwAllMuzakki';
  private $baseModelView;
  private $baseModel;
  private $controller;

  public function __construct()
  {
    $this->baseModel = new BaseModel($this->table);
    $this->baseModelView = new BaseModel($this->view);
    $this->controller = new Controller();
  }

  /**
   * -------------------------------------------------------
   *                  GET ALL DATA
   * -------------------------------------------------------
   */

  /**
   * Mengambil semua data dari tabel yang sesuai dengan tampilan yang ditentukan.
   *
   * @return array Data yang berisi semua entri dari tabel yang sesuai.
   */
  public function getAllData(): array
  {
    $this->baseModelView->selectData();
    return $this->baseModelView->fetchAll();
  }

  /**
   * ---------------------------------------------------------
   *                  GET DATA BY ??
   * ---------------------------------------------------------
   */

  /**
   * Mengambil data tunggal berdasarkan ID pengguna.
   *
   * @param int $id_user ID pengguna yang akan digunakan untuk mencari data.
   * @return array Data yang cocok dengan ID pengguna yang diberikan.
   */
  public function getDataByIdUser(int $id_user): array
  {
    $this->baseModel->selectData(null, null, [], ["id_user = ", $id_user]);
    return $this->baseModel->fetch();
  }

  /**
   * Mengambil data muzakki berdasarkan nama pengguna.
   *
   * @param string $username Nama pengguna yang akan digunakan untuk mencari data muzakki.
   * @return array Data yang sesuai dengan nama pengguna yang diberikan.
   */
  public function getDataByUsername($username): array
  {
    $this->baseModelView->selectData(null, null, [], ["username = " => $username]);
    return $this->baseModelView->fetch();
  }


  /**
   * -----------------------------------------------------------
   *                  DATA ACTION
   * -----------------------------------------------------------
   */

  /**
   * Mengupdate data muzakki berdasarkan ID pengguna.
   *
   * @param int   $id_user ID pengguna dari tabel tb_muzakki.
   * @param array $data    Data yang akan diupdate, termasuk nama, username, dan nohp.
   * @return int|string    1 jika berhasil diupdate, 0 jika tidak. Pesan kesalahan jika terjadi.
   */
  public function updateData(int $id_user, array $data): int|string
  {

    // Menginisialisasi variabel dari data post
    $nama       = htmlspecialchars(trim($data['nama']));
    $username   = htmlspecialchars(trim($data['username']));
    $nohp       = $data['nohp'];

    // cek data username
    $cekUsername = $this->controller->model('User_model')->getIdByUsername($username);

    // jika username ada pada database dan tidak sama dengan id user
    if (!is_bool($cekUsername) && $cekUsername['id_user'] !== $id_user) return "Username sudah terdafar!";

    // jika username tidak ada pada database
    if (is_bool($cekUsername)) {
      // update username
      $updateUsername = $this->controller->model('User_model')->updateDataById(['username' => $username], $id_user);
      $isUser = ($updateUsername > 0) ? true : false;

      // set session username
      $_SESSION['username'] = $username;
    }

    // update data muzakki
    $data = [
      "nama" => $nama,
      "nohp" => $nohp
    ];
    $update = $this->baseModel->updateData($data, ["id_user" => $id_user]);
    $isMuzakki = ($update > 0) ? true : false;

    return ($isMuzakki || $isUser) ? 1 : 0;
  }

  /**
   * Menghapus data pengguna berdasarkan UUID.
   *
   * @param string $uuid UUID pengguna yang akan dihapus.
   * @return int Jumlah baris yang terpengaruh akibat penghapusan.
   */
  public function deleteData(string $uuid): int
  {
    $kondisi = ["id_user" => $uuid];
    return $this->baseModel->deleteData($kondisi);
  }
}
