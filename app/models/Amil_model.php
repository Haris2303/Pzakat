<?php

class Amil_model {
  
  private $view   = 'vwAllAmil';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }


  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  GET ALL DATA
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */

  // get all data amil
  public function getAllData(): array {
    $query = "SELECT * FROM $this->view";
    $this->db->query($query);
    return $this->db->resultSet();
  }


  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  GET DATA BY
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */

  // get data amil by id
  public function getDataByUsername($username): array {
    $query = "SELECT * FROM $this->view WHERE username = :username";
    $this->db->query($query);
    $this->db->bind('username', $username);
    return $this->db->single();

  }

  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                    ACTION DATA
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */
  // method hapus data amil
  public function deleteAmil(string $token): int {
    // initial query
    $query = "DELETE FROM tb_user WHERE token = :token";

    // execute
    $this->db->query($query);
    $this->db->bind('token', $token);
    $this->db->execute();

    return $this->db->rowCount();
  }

}