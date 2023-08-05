<?php

class Useradmin_model
{
  private $table  = [
    'admin' => 'tb_admin',
    'user'  => 'tb_user'
  ];
  private $view   = 'vwAllAdmin';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  /**
   * ------------------------------------------------------------------------------------------------------------------------------
   *          GET DATA
   * -------------------------------------------------------------------------------------------------------------------------------
   */

  // get data by username
  public function getDataByUsername($username): array {
    $query = "SELECT * FROM $this->view WHERE username = :username";
    $this->db->query($query);
    $this->db->bind('username', $username);
    return $this->db->single();
  }

  public function addUserAdmin($data)
  {

    // deklarsi variabel
    $tableAdmin = $this->table['admin'];
    $tableUser    = $this->table['user'];

    // assignment query
    $queryUser   = "INSERT INTO $tableUser VALUES(NULL, :username, :password, NOW(), '1')";
    $queryAmil   = "INSERT INTO $tableAdmin VALUES(NULL, :id_user, :nama)";
    $cekdataUser = "SELECT username FROM $tableUser WHERE username = :username";

    // cek username
    $this->db->query($cekdataUser);
    $this->db->bind('username', $data['username']);
    if(count($this->db->resultSet()) > 0) return 'Username Sudah Ada!';

    // cek panjang password
    if(strlen($data['password']) < 8) return 'Password Terlalu Lemah!';

    // password konfirmasi
    if($data['password'] === $data['passConfirm']) {

      // insert data user
      $this->db->query($queryUser);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->execute();

      // get id user
      $this->db->query("SELECT id_user FROM $tableUser WHERE username = :username");
      $this->db->bind('username', $data['username']);
      $id_user = $this->db->single()['id_user'];

      // insert data admin
      $this->db->query($queryAmil);
      $this->db->bind('id_user', $id_user);
      $this->db->bind('nama', htmlspecialchars($data['nama']));
      $this->db->execute();

      return $this->db->rowCount();

    }

    return "Konfirmasi Password Tidak Sama!";
  }

  // method get data admin
  public function getAllDataAdmin(): array {

    $query = "SELECT * FROM $this->view";
    $this->db->query($query);
    return $this->db->resultSet();

  }

}
