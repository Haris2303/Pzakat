<?php

class Login_model {

  private $table = 'tb_user';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function login($data): int {
    
    // QUERY
    $query = "SELECT * FROM $this->table WHERE username = :username";

    // cek username data query muzakki
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->execute();

    // initialisasi data result 
    $row = $this->db->single();

    // cek username
    if(count($row) > 0) {
      // cek password
      $dbPass = $row['password'];
      if(password_verify($data['password'], $dbPass)) {
        // set session
        $_SESSION['level'] = $row['level'];
        return $this->db->rowCount();
      }
    }

    return 0;

  }
}