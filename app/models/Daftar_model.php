<?php

class Daftar_model
{

  private $table = [
    "muzakki" => "tb_muzakki",
    "amil"    => "tb_amil"
  ];
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  // method daftar muzakki
  public function daftarMuzakki($data): int
  {
    // deklarsi variabel
    $tableMuzakki = $this->table['muzakki'];

    // assignment query
    $queryMuzakki  = "INSERT INTO $tableMuzakki VALUES(NULL, :username, :password, :nama, :email, :nohp, NOW(), :level)";
    $cekdata       = "SELECT username, email, nohp FROM $tableMuzakki WHERE username = :username AND email = :email AND nohp = :nohp";

    // check if the email and nohp data already exists
    $this->db->query($cekdata);
    $this->db->bind('username', $data['username']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('nohp', $data['nohp']);
    $this->db->execute();
    if ($this->db->rowCount() > 0) return 0;

    // cek password dan konfirmasi password
    if($data['password'] === $data['passConfirm']) {
      // execution muzakki query and binding
      $this->db->query($queryMuzakki);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->bind('nama', htmlspecialchars($data['name']));
      $this->db->bind('email', htmlspecialchars($data['email']));
      $this->db->bind('nohp', htmlspecialchars($data['nohp']));
      $this->db->bind('level', '3');
      $this->db->execute();

      return $this->db->rowCount();
    }

    return 0;
  }

  // method daftar amil
  public function daftarAmil($data): int
  {
    // deklarsi variabel
    $tableAmil = $this->table['amil'];

    // assignment query
    $query    = "INSERT INTO $tableAmil VALUES(NULL, :id_masjid, :username, :password, :nama, :email, :nohp, :alamat, NOW(), :level, :status_verifikasi)";
    $cekdata  = "SELECT username, email, nohp FROM $tableAmil WHERE username = :username OR email = :email OR nohp = :nohp";

    // check if the email and nohp data already exists
    $this->db->query($cekdata); 
    $this->db->bind('username', $data['username']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('nohp', $data['nohp']);
    $this->db->execute();
    if($this->db->rowCount() > 0) return 0;

    // cek password dan konfirmasi password
    if($data['password'] === $data['passConfirm']) {
      // execution muzakki query and binding
      $this->db->query($query);
      $this->db->bind('id_masjid', $data['masjid']);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->bind('nama', htmlspecialchars($data['name']));
      $this->db->bind('email', htmlspecialchars($data['email']));
      $this->db->bind('nohp', htmlspecialchars($data['nohp']));
      $this->db->bind('alamat', htmlspecialchars($data['alamat']));
      $this->db->bind('level', '2');
      $this->db->bind('status_verifikasi', '0');
      $this->db->execute();

      return $this->db->rowCount();
    }

    return 0;
  }
}
