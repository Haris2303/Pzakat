<?php

class Useradmin_model
{

  private $table = 'tb_admin';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  public function addUserAdmin($data): int
  {

    $querySelect = "SELECT username FROM $this->table WHERE username = :username";
    $queryInsert = "INSERT INTO $this->table VALUES(NULL, :username, :password, :nama, NOW(), '1')";

    // check if the username  data already exists
    $this->db->query($querySelect);
    $this->db->bind('username', $data['username']);
    $this->db->execute();

    // cek konfirmasi password dan username
    if ($data['password'] === $data['passwordKonfirmasi'] && $this->db->rowCount() === 0) {
      // execution muzakki query and binding
      $this->db->query($queryInsert);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->bind('nama', htmlspecialchars($data['nama']));
      $this->db->execute();

      return $this->db->rowCount();
    }

    return 0;
  }

  // method get data admin
  public function getAllDataAdmin(): array {

    $query = "SELECT username, nama, waktu_login FROM $this->table";
    $this->db->query($query);
    return $this->db->resultSet();

  }

}
