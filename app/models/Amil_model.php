<?php

class Amil_model {
  
  private $view   = 'vwAllAmill';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  // get all data amil
  public function getAllDataAmil(): array {

    $query = "SELECT * FROM $this->view";
    $this->db->query($query);
    return $this->db->resultSet();
  }

  // get data amil by id
  public function getDataAmilByUsername($username): array {

    $query = "SELECT * FROM $this->view WHERE username = :username";
    $this->db->query($query);
    $this->db->bind('username', $username);
    return $this->db->single();
  }

  // method verifikasi amil
  public function verifikasi($id): int {

    $query = "UPDATE $this->view SET status_verifikasi = '1' WHERE username = :username";
    $this->db->query($query);
    $this->db->bind('username', $id);
    $this->db->execute();

    return $this->db->rowCount();
    
  }

}