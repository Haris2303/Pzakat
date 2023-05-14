<?php

class Masjid_model {

  private $table = 'tb_mesjid';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  // method get data masjid
  public function getDataMasjid(): array {

    $query = "SELECT * FROM $this->table";

    $this->db->query($query);
    return $this->db->resultSet();

  }

}