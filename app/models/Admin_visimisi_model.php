<?php

class Admin_visimisi_model {

  private $table = 'tb_visimisi';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function changeVisiMisi($data): int {

    // query
    $query = "SELECT * FROM $this->table";
    $this->db->query($query);
    $this->db->execute();
    $this->db->rowCount();

    if($this->db->rowCount() === 0) {
      $queryInsert = "INSERT INTO $this->table VALUES(NULL, :username, :content, NOW());";
      $this->db->query($queryInsert);
      $this->db->bind('content', $data['textarea']);
      $this->db->bind('username', 'Admin');
      $this->db->execute();
      return $this->db->rowCount();
    } else {
      $queryChange = "UPDATE $this->table SET content = :content, datetime = NOW()";
      $this->db->query($queryChange);
      $this->db->bind('content', $data['textarea']);
      $this->db->execute();
      return $this->db->rowCount();
    }

  }

}