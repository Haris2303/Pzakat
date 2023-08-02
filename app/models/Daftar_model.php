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

  public function daftarUser(string $user, array $data) {
    // buat $user jadi lowercase
    $user = strtolower($user);

    // deklarsi variabel
    $tipeUser   = $this->table[$user];
    $tb_user    = $this->table['user'];

    // cek user
    if($user === 'amil') {
      $level      = '2';
      $queryAmil  = "INSERT INTO $tipeUser VALUES(NULL, :id_user, :id_masjid, :nama, :email, :nohp, :alamat)";
    }
    if($user === 'muzakki') {
      $level        = '3';
      $queryMuzakki = "INSERT INTO $tipeUser VALUES(NULL, :id_user, :nama, :email, :nohp)";
    }
    
    $query_user     = "INSERT INTO $tb_user VALUES(NULL, :username, :password, :token, NOW(), '$level', '0')";
    $cek_email_nohp  = "SELECT email, nohp FROM $tipeUser WHERE email = :email OR nohp = :nohp";
    $cek_username   = "SELECT username FROM $tb_user WHERE username = :username";

    // cek username
    $this->db->query($cek_username);
    $this->db->bind('username', $data['username']);
    if(count($this->db->resultSet()) > 0) return 'Usename is already available!';

    // cek email dan nohp
    $this->db->query($cek_email_nohp);
    $this->db->bind('email', $data['email']);
    $this->db->bind('nohp', $data['nohp']);
    if(count($this->db->resultSet()) > 0) return 'Email or NoHP is already available!';

    // generate token
    $token = base64_encode(random_bytes(32));
    // delete character '/' and '='
    $token = trim($token, '=');
    $token = explode('/', $token); // delete character '/'
    $token = join('', $token);
    $token = explode('+', $token); // delete character '+'
    $token = urlencode(join('', $token));

    // cek panjang password
    if(strlen($data['password'] < 8)) return 'Password Terlalu Lemah!';

    // password konfirmasi
    if($data['password'] === $data['passConfirm']) {

      // insert data user
      $this->db->query($query_user);
      $this->db->bind('username', htmlspecialchars($data['username']));
      $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
      $this->db->bind('token', $token);
      $this->db->execute();

      if($this->db->rowCount() > 0) {

        // get id user
        $this->db->query("SELECT id_user FROM $tb_user WHERE username = :username");
        $this->db->bind('username', $data['username']);
        $id_user = $this->db->single()['id_user'];

        if($user === 'muzakki') {
          // insert data muzakki
          $this->db->query($queryMuzakki);
          $this->db->bind('id_user', $id_user);
          $this->db->bind('nama', htmlspecialchars($data['name']));
          $this->db->bind('email', htmlspecialchars($data['email']));
          $this->db->bind('nohp', htmlspecialchars($data['nohp']));
          $this->db->execute();
        }

        if($user === 'amil') {
          // insert data amil
          $this->db->query($queryAmil);
          $this->db->bind('id_user', $id_user);
          $this->db->bind('id_masjid', $data['masjid']);
          $this->db->bind('nama', htmlspecialchars($data['name']));
          $this->db->bind('email', htmlspecialchars($data['email']));
          $this->db->bind('nohp', htmlspecialchars($data['nohp']));
          $this->db->bind('alamat', htmlspecialchars($data['alamat']));
          $this->db->execute();
        }
        
        return $this->db->rowCount();
      }
    }

    return 'Konfirmasi password tidak sama!';
    
  }

}
