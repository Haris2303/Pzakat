<?php 

class Muzakki_model {

  private $table = 'tb_muzakki';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllDataMuzakki(): array {
    $query = "SELECT * FROM $this->table";
    $this->db->query($query);
    return $this->db->resultSet();
  }

}