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
     * |        GET RECORD By
     * |---------------------------------------------------------------------------------------------------------------------
     */
    public function getIdByUsername(string $username): int {
        $query = "SELECT id_user FROM $this->table WHERE username = :username";
        $this->db->query($query);
        $this->db->bind('username', $username);
        return $this->db->single()['id_user'];
    }

    /**
     * |---------------------------------------------------------------------------------------------------------------------
     * |        CHECK DATA
     * |---------------------------------------------------------------------------------------------------------------------
     */
    
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