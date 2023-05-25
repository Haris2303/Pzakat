<?php

class Daftar_model
{

  private $table = [
    "user"    => "tb_user",
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
  public function daftarMuzakki($data)
  {
    // deklarsi variabel
    $tableMuzakki = $this->table['muzakki'];
    $tableUser    = $this->table['user'];

    // assignment query
    $queryUser      = "INSERT INTO $tableUser VALUES(NULL, :username, :password, NOW(), '3')";
    $queryMuzakki   = "INSERT INTO $tableMuzakki VALUES(NULL, :id_user, :nama, :email, :nohp)";
    $cekdataUser    = "SELECT username FROM $tableUser WHERE username = :username";
    $cekDataMuzakki = "SELECT email, nohp FROM $tableMuzakki WHERE email = :email OR nohp = :nohp";

    // cek username
    $this->db->query($cekdataUser);
    $this->db->bind('username', $data['username']);
    if(count($this->db->resultSet()) > 0) return 'Usename is already available!';

    // cek email dan nohp
    $this->db->query($cekDataMuzakki);
    $this->db->bind('email', $data['email']);
    $this->db->bind('nohp', $data['nohp']);
    if(count($this->db->resultSet()) > 0) return 'Email or NoHP is already available!';

    // cek panjang password
    if(strlen($data['password'] < 8)) return 'Password Terlalu Lemah!';

    // password konfirmasi
    if($data['password'] === $data['passConfirm']) {

      // insert data user
      $this->db->query($queryUser);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->execute();
      $this->db->query("SELECT id_user FROM $tableUser WHERE username = :username");
      $this->db->bind('username', $data['username']);
      $row['id_user'] = $this->db->single()['id_user'];

      // insert data muzakki
      $this->db->query($queryMuzakki);
      $this->db->bind('id_user', $row['id_user']);
      $this->db->bind('nama', htmlspecialchars($data['name']));
      $this->db->bind('email', htmlspecialchars($data['email']));
      $this->db->bind('nohp', htmlspecialchars($data['nohp']));
      $this->db->execute();

      return $this->db->rowCount();

    }

    return 'Konfirmasi Password Tidak Sama!';
  }

  // method daftar amil
  public function daftarAmil($data)
  {
    // deklarsi variabel
    $tableAmil = $this->table['amil'];
    $tableUser    = $this->table['user'];

    // assignment query
    $queryUser   = "INSERT INTO $tableUser VALUES(NULL, :username, :password, NOW(), '2')";
    $queryAmil   = "INSERT INTO $tableAmil VALUES(NULL, :id_user, :id_masjid, :nama, :email, :nohp, :alamat)";
    $cekdataUser = "SELECT username FROM $tableUser WHERE username = :username";
    $cekDataAmil = "SELECT email, nohp FROM $tableAmil WHERE email = :email OR nohp = :nohp";

    // cek username
    $this->db->query($cekdataUser);
    $this->db->bind('username', $data['username']);
    if(count($this->db->resultSet()) > 0) return 'Username Sudah Ada!';

    // cek email dan nohp
    $this->db->query($cekDataAmil);
    $this->db->bind('email', $data['email']);
    $this->db->bind('nohp', $data['nohp']);
    if(count($this->db->resultSet()) > 0) return 'Email Atau No HP Sudah Ada!';

    if(strlen($data['password']) < 8) return 'Password Terlalu Lemah';
    
    // password konfirmasi dan panjang password
    if($data['password'] === $data['passConfirm']) {

      // insert data user
      $this->db->query($queryUser);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->execute();

      // get id user
      $this->db->query("SELECT id_user FROM $tableUser WHERE username = :username");
      $this->db->bind('username', $data['username']);
      $row['id_user'] = $this->db->single()['id_user'];

      // insert data Amil
      $this->db->query($queryAmil);
      $this->db->bind('id_user', $row['id_user']);
      $this->db->bind('id_masjid', $data['masjid']);
      $this->db->bind('nama', htmlspecialchars($data['name']));
      $this->db->bind('email', htmlspecialchars($data['email']));
      $this->db->bind('nohp', htmlspecialchars($data['nohp']));
      $this->db->bind('alamat', htmlspecialchars($data['alamat']));
      $this->db->execute();

      return $this->db->rowCount();

    }

    return 'Konfirmasi Password Tidak Sama!';
  }
}
