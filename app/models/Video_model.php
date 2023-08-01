<?php

class Video_model {

    private $db;
    private $table = 'tb_video';

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getData(): array {
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->single();
    }

    public function ubahData(array $data): int {
        $link = $data['link'];

        $query = "UPDATE $this->table SET link = '$link', datetime = NOW()";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount();
    }

}