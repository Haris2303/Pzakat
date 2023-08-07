<?php

class Daftar_model
{

  private $table = [
    "user"    => "tb_user",
    "muzakki" => "tb_muzakki",
    "amil"    => "tb_amil"
  ];
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

}
