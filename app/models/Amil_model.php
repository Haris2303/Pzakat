<?php

class Amil_model {

  private $table = 'tb_amil';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  // get all data amil
  public function getAllDataAmil(): array {

    $query = "SELECT nama, email, nohp, waktu_login, status_verifikasi FROM $this->table";
    $this->db->query($query);
    return $this->db->resultSet();
  }

}