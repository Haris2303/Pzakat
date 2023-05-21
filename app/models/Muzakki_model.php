<?php 

class Muzakki_model {

  private $table = [
    "muzakki" => "tb_muzakki", 
    "user"    => "tb_user"
  ];
  private $view = 'vwAllMuzakki';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllDataMuzakki(): array {
    $query = "SELECT * FROM $this->view"; 
    $this->db->query($query);
    return $this->db->resultSet();
  }

}