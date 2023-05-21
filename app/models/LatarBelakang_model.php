<?php

class LatarBelakang_model {

  private $table = 'tb_latarbelakang';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getLatarBelakang(): array
  {
    // query
    $query = "SELECT * FROM $this->table";
    $this->db->query($query);
    // return single data
    return $this->db->single();
  }

}