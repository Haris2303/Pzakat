<?php

class User_model {

    private $db;
    private $table = 'tb_user';

    // constructor
    public function __construct() 
    {
        $this->db = new Database();
    }

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        GET DATA By
     * |---------------------------------------------------------------------------------------------------------------------
     */
    public function getIdByUsername(string $username): int {
        $query = "SELECT id_user FROM $this->table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single()['id_user'];
    }

    public function getTokenByUsername(string $username): string {
        $query = "SELECT token FROM $this->table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single()['token'];
    }

    public function getNamaByIdUser(int $id_user): string {
        // cek pada tb_admin
        $query = "SELECT nama FROM tb_admin WHERE id_user = $id_user";
        $this->db->query($query);
        $nama = $this->db->single()['nama'];
        if(is_string($nama)) return $nama;

        // cek pada tb_amil
        $query = "SELECT nama FROM tb_amil WHERE id_user = $id_user";
        $this->db->query($query);
        $nama = $this->db->single()['nama'];
        if(is_string($nama)) return $nama;

        // cek pada tb_muzakki
        $query = "SELECT nama FROM tb_muzakki WHERE id_user = $id_user";
        $this->db->query($query);
        $nama = $this->db->single()['nama'];
        if(is_string($nama)) return $nama;
        
    } 

    /**
     * -----------------------------------------------------------------------------------------------------------------------------
     *      AKTIVASI AKUN
     * ----------------------------------------------------------------------------------------------------------------------------
     */
    public function aktivasiAkun(string $token): int {
        $query = "UPDATE $this->table SET status_aktivasi = '1' WHERE token = '$token'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    } 

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        CHECK DATA
     * |---------------------------------------------------------------------------------------------------------------------
     */
    // check token
    public function isToken(string $token): bool {
        $query = "SELECT token FROM tb_user WHERE token = '$token'";
        $this->db->query($query);
        if(is_bool($this->db->single())) return false;
        return true;
    }
    
    /**
     * @param string $email tidak boleh kosong
     * @return true(jika valid)|`false`(jika tidak valid)
     */
    public function isEmail(string $email, int $id_user): bool {

        $query = "SELECT email FROM tb_amil WHERE (email = '$email' AND id_user <> $id_user)";
        $this->db->query($query);
        if(is_string($this->db->single()['email'])) return true;

        $query = "SELECT email FROM tb_muzakki WHERE (email = '$email' AND id_user <> $id_user)";
        $this->db->query($query);
        if(is_string($this->db->single()['email'])) return true;
        
        return false;
    }


}