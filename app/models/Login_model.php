<?php

class Login_model {

  private $tableUser = 'tb_user';
  private $tableAmil = 'tb_amil';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function login($data) {

    $tb_user = $this->tableUser;
    $tb_amil = $this->tableAmil;
    
    // QUERY
    $query = "SELECT *,-password FROM $tb_user INNER JOIN $tb_amil ON $tb_user.id_user = $tb_amil.id_user WHERE username = :username";

    // cek username data query muzakki
    $this->db->query($query);
    $this->db->bind('username', $data['username']);

    // cek username
    if(count($this->db->resultSet()) > 0) {
      // initialisasi data pada row
      $row = $this->db->resultSet()[0];

      // cek password
      $dbPass = $row['password'];
      if(password_verify($data['password'], $dbPass)) {
        // initialisasi session
        session_reset();
        $_SESSION = [];
        $_SESSION['id_amil']  = $row['id_amil'];
        $_SESSION['level']    = $row['level'];
        $_SESSION['username'] = $row['username'];
        return 1;
      }
    }

    return 'Username atau Password Salah!';

  }
}