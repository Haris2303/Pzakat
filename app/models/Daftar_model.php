<?php

class Daftar_model {

  private $table = [
    "muzakki" => "tb_muzakki",
    "user" => "tb_user"
  ];
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function daftarMuzakki($data): int {
    // query
    $queryUser    = "INSERT INTO $this->table->user VALUES(NULL, :username, :password, 'online', :waktu_login)";
    return 0;
  }
  
}