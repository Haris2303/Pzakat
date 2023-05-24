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

  // method get data masjid by id
  public function getDataMasjidById($id): array {

    $query = "SELECT * FROM $this->table WHERE id_mesjid = :id_mesjid";
    $this->db->query($query);
    $this->db->bind('id_mesjid', $id);
    $result = $this->db->single();
    return $result;

  }

}