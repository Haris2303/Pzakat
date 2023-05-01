<?php

class Daftar_model
{

  private $table = [
    "muzakki" => "tb_muzakki",
    "user" => "tb_user"
  ];
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function daftarMuzakki($data): int
  {
    // deklarsi variabel
    $tableUser    = $this->table['user'];
    $tableMuzakki = $this->table['muzakki'];

    // assignment query
    $queryUser            = "INSERT INTO $tableUser VALUES(NULL, :username, :password, :status_login, NOW(), :level)";
    $queryMuzakki         = "INSERT INTO $tableMuzakki VALUES(NULL, :name, :email, :nohp)";
    $selectDataUsername   = "SELECT username FROM $tableUser WHERE username = '" . $data['username'] . "'";
    $selectDataEmailNohp  = "SELECT email, nohp FROM $tableMuzakki WHERE email = '" . $data['email'] . "' AND nohp = '" . $data['nohp'] . "'";

    // check the similarity of the password and confirm the password
    if ($data['password'] !== $data['passConfirm']) return 0;

    // check if the username data already exists
    $this->db->query($selectDataUsername);
    $this->db->execute();
    if ($this->db->rowCount() > 0) return 0;

    // // check if the email and nohp data already exists
    $this->db->query($selectDataEmailNohp);
    $this->db->execute();
    if ($this->db->rowCount() > 0) return 0;

    // execution user query and binding
    $this->db->query($queryUser);
    $this->db->bind('username', htmlspecialchars($data['username']));
    $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
    $this->db->bind('status_login', 'online');
    $this->db->bind('level', '3');
    $this->db->execute();

    // check user query success or failed
    if ($this->db->rowCount() > 0) {
      // execution muzakki query and binding
      $this->db->query($queryMuzakki);
      $this->db->bind('name', htmlspecialchars($data['name']));
      $this->db->bind('email', htmlspecialchars($data['email']));
      $this->db->bind('nohp', htmlspecialchars($data['nohp']));
      $this->db->execute();

      return $this->db->rowCount();
    }

    return 0;
  }
}
