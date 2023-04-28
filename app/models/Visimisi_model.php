<?php

class Visimisi_model {

  private $table = 'tb_visimisi';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getVisiMisi(): array {

    $query = "SELECT * FROM $this->table";
    $this->db->query($query);
    return $this->db->single();

  }

}