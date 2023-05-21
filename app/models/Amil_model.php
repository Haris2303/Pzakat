<?php

class Amil_model {
  
  private $view   = 'vwAllAmil';
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

}