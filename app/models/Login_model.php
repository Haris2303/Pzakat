<?php

class Login_model {
  private $table = [
    "admin"   => "tb_admin",
    "amil"    => "tb_amil" ,
    "muzakki" => "tb_muzakki"
  ];
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function login($data): int {
    // initialisasi
    $admin    = $this->table['admin'];
    $amil     = $this->table['amil'];
    $muzakki  = $this->table['muzakki'];
    
    $queryAdmin   = "SELECT username, password, level FROM $admin WHERE username = :username";
    $queryAmil    = "SELECT username, password, level FROM $amil WHERE username = :username";
    $queryMuzakki = "SELECT username, password, level FROM $muzakki WHERE username = :username";

    // cek username data query muzakki
    $this->db->query($queryMuzakki);
    $this->db->bind('username', $data['username']);
    // cek password
    if($this->db->single() === 0) {
      return 0;
    }
    $result = $this->db->resultSet();

    // ambil data user
    // foreach($result as $data) {
    //   if(count($result) == 1) {
    //     $_SESSION['username'] = $data['username'];
    //     $_SESSION['level'] = $data['level'];
    //   }
    // }

    return $result;

  }
}