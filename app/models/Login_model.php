<?php

class Login_model {

  private $tableUser = 'tb_user';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function login($data): int|string {

    $tb_user = $this->tableUser;
    
    // QUERY
    $query = "SELECT *,-password FROM $tb_user WHERE username = :username";

    // cek username data query muzakki
    $this->db->query($query);
    $this->db->bind('username', $data['username']);

    // cek username
    if(count($this->db->resultSet()) > 0) {
      // initialisasi data pada row
      $row = $this->db->resultSet()[0];

      // cek password
      $dbPass = $row['password'];
      if(password_verify($data['password'], $dbPass)) {
        // initialisasi session
        session_reset();
        $_SESSION = [];
        $_SESSION['level']    = $row['level'];
        $_SESSION['username'] = $row['username'];
        return 1;
      }
    }

    return 'Username atau Password Salah!';

  }

  public function getUserId(string $email): int {

    // check on tb_muzakki
    $query = "SELECT id_user FROM tb_muzakki WHERE email = :email";
    $this->db->query($query);
    $this->db->bind('email', $email);

    if(is_bool($this->db->single())) {
      // check on tb_amil
      $query = "SELECT id_user FROM tb_amil WHERE email = :email";
      $this->db->query($query);
      $this->db->bind('email', $email);
    }

    return $this->db->single()['id_user'];

  }

  public function ubahPassword(array $data): int|string {

    $password1 = $data['password_baru'];
    $password2 = $data['password_konfirmasi'];
    $token = $data['token'];

    // check length password
    if(strlen($password1) < 8) return 'Panjang password harus lebih dari 8 karakter';

    // check confirmation password
    if($password1 !== $password2) return 'Password konfirmasi tidak valid!';

    // encrypt password
    $password1 = password_hash($password1, PASSWORD_DEFAULT);

    // update password
    $update = "UPDATE $this->tableUser SET password = :password WHERE token = :token";
    $this->db->query($update);
    $this->db->bind('password', $password1);
    $this->db->bind('token', $token);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function checkEmail($email): int {
    // check on tb_muzakki
    $query = "SELECT email FROM tb_muzakki WHERE email = :email";
    $this->db->query($query);
    $this->db->bind('email', $email);
    $this->db->execute();

    if($this->db->rowCount() <= 0) {
      // check on tb_amil
      $query = "SELECT email FROM tb_amil WHERE email = :email";
      $this->db->query($query);
      $this->db->bind('email', $email);
      $this->db->execute();
      return $this->db->rowCount();
    }
    
    return $this->db->rowCount();

  }

  public function checkToken($token): array|bool {
    // check on tb_muzakki
    $query = "SELECT token FROM tb_user WHERE token = :token";
    $this->db->query($query);
    $this->db->bind('token', $token);

    return $this->db->single();
  }

  public function updateToken($token, $user_id): string {
    $query = "UPDATE tb_user SET token = :token WHERE id_user = :id_user";
    $this->db->query($query);
    $this->db->bind('token', $token);
    $this->db->bind('id_user', $user_id);
    $this->db->execute();

    if($this->db->rowCount() > 0) {
      $query = "SELECT token FROM tb_user WHERE token = :token";
      $this->db->query($query);
      $this->db->bind('token', $token);
      return $this->db->single()['token'];  
    }
  }

}