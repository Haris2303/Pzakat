<?php

class Muzakki_model
{

  private $table = 'tb_muzakki';
  private $view = 'vwAllMuzakki';
  private $db;
  private $baseModel;
  private $controller;

  public function __construct()
  {
    $this->db = new Database();
    $this->baseModel = new BaseModel($this->table);
    $this->controller = new Controller();
  }

  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  GET ALL DATA
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */
  public function getAllData(): array
  {
    $query = "SELECT * FROM $this->view";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  GET DATA BY ??
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */
  // get single data by id
  public function getDataByIdUser(int $id_user): array {
    $query = "SELECT * FROM $this->table WHERE id_user = :id_user";
    $this->db->query($query);
    $this->db->bind('id_user', $id_user);
    return $this->db->single();
  }

  // get data muzakki by username
  public function getDataByUsername($username): array
  {
    $query = "SELECT * FROM $this->view WHERE username = :username";
    $this->db->query($query);
    $this->db->bind('username', $username);
    return $this->db->single();
  }


  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  DATA ACTION
   * ------------------------------------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * @param int $id_user id_user yang ada pada tb_muzakki
   * @param array $data data post
   */
  public function updateData(int $id_user, array $data): int|string
  {

    $nama       = htmlspecialchars(trim($data['nama']));
    $username   = htmlspecialchars(trim($data['username']));
    $nohp       = $data['nohp'];

    $cekUsername = $this->controller->model('User_model')->getIdByUsername($username);

    // jika username ada pada database dan tidak sama dengan id user
    if (!is_bool($cekUsername) && $cekUsername['id_user'] !== $id_user) return "Username sudah terdafar!";

    // jika username tidak ada pada database
    if(is_bool($cekUsername)) {
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

  public function deleteData(string $uuid): int {
    $kondisi = ["id_user" => $uuid];
    return $this->baseModel->deleteData($kondisi);
  }
}
