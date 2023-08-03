<?php 

class Muzakki_model {

  private $table = [
    "muzakki" => "tb_muzakki", 
    "user"    => "tb_user"
  ];
  private $view = 'vwAllMuzakki';
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getAllDataMuzakki(): array {
    $query = "SELECT * FROM $this->view"; 
    $this->db->query($query);
    return $this->db->resultSet();
  }

  // get data muzakki by username
  public function getDataByUsername($username): array {
    $query = "SELECT * FROM $this->view WHERE username = :username";
    $this->db->query($query);
    $this->db->bind('username', $username);
    return $this->db->single();
  }

  public function ubahProfil(int $id_user, array $data): int {
    $tb_user = $this->table['user'];
    $tb_muzakki = $this->table['muzakki'];
    
    $nama       = htmlspecialchars(trim($data['nama']));
    $username   = htmlspecialchars(trim($data['username']));
    $nohp       = $data['nohp'];

    // cek username jika sama
    $cek = "SELECT username FROM $tb_user WHERE username = :username";
    $this->db->query($cek);
    $this->db->bind('username', $username);
    if(is_bool($this->db->single())) {
      // update username
      $query = "UPDATE $tb_user SET username = :username WHERE id_user = :id_user";
      $this->db->query($query);
      $this->db->bind('username', $username);
      $this->db->bind('id_user', $id_user);
      $this->db->execute();
      $isUser = ($this->db->rowCount() > 0) ? true : false;

      // set session username
      $_SESSION['username'] = $username;
    }

    // update data muzakki
    $query = "UPDATE $tb_muzakki SET nama = :nama, nohp = :nohp WHERE id_user = :id_user";
    $this->db->query($query);
    $this->db->bind('nama', $nama);
    $this->db->bind('nohp', $nohp);
    $this->db->bind('id_user', $id_user);
    $this->db->execute();
    $isMuzakki = ($this->db->rowCount() > 0) ? true : false;

    return ($isMuzakki || $isUser) ? 1 : 0;
  }

}