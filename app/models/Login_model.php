<?php

class Login_model {

  private $table = 'tb_user';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function login($data) {
    
    // QUERY
    $query = "SELECT * FROM $this->table WHERE username = :username";

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
        $_SESSION['level'] = $row['level'];
        $_SESSION['username'] = $row['username'];
        return 1;
      }
    }

    return 'Username atau Password Salah!';

  }
}