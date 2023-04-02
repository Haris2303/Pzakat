<?php

class Login_model {
  private $table = 'tb_user';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function login($data): int {
    // cek data input
    $query = "SELECT * FROM $this->table WHERE username = :username and password = :password";
    $this->db->query($query);
    $this->db->bind('username', $data['username']);
    $this->db->bind('password', $data['password']);
    $this->db->execute();
    
    $rowCount = $this->db->rowCount();
    $result = $this->db->resultSet();

    // ambil data user
    foreach($result as $data) {
      if(count($result) == 1) {
        $_SESSION['username'] = $data['username'];
        $_SESSION['status'] = $data['status'];
        $_SESSION['level'] = $data['level'];
      }
    }

    return $rowCount;

  }
}