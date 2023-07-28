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

}