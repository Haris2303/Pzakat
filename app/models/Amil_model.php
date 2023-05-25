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

  // method ubah data amil
  public function ubahAmil($data): int {
    // initial data
    $username     = $data['username'];
    $password     = $data['password'];
    $passConfirm  = $data['passConfirm'];

    // get id user
    $this->db->query("SELECT id_user FROM tb_user WHERE username = :username");
    $this->db->bind('username', $username);
    $dataUser = $this->db->single();

    // cek konfirmasi password
    if(strlen($password) < 8 || $password !== $passConfirm) return 0;
    
    // encrypt password
    $password = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE tb_user SET password = :password WHERE id_user = :id_user";
    $this->db->query($query);
    $this->db->bind('password', $password);
    $this->db->bind('id_user', $dataUser['id_user']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  // method hapus data amil
  public function hapusAmil($id_user): int {
    // initial query
    $query = "DELETE FROM tb_user WHERE id_user = $id_user";

    // execute
    $this->db->query($query);
    $this->db->execute();

    return $this->db->rowCount();
  }

}