<?php

class Profile_model {

    private $table = [
        'amil' => 'tb_amil',
        'admin' => 'tb_admin'
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function ubahProfilAmil(array $data, string $username) {
        // init variabel
        $table = $this->table['amil'];
        $nama_amil  = $data['nama_amil'];
        $email      = $data['email'];
        $nohp       = $data['nohp'];
        $id_mesjid  = (int) $data['id_mesjid'];
        $alamat     = $data['alamat'];

        // get id user by username
        $id_user = "SELECT id_user FROM tb_user WHERE username = :username";
        $this->db->query($id_user);
        $this->db->bind('username', $username);
        $id_user = $this->db->single()['id_user'];

        // ubah data
        $query = "UPDATE $table SET id_mesjid = :id_mesjid,
                                     nama = :nama_amil, 
                                     email = :email, 
                                     nohp = :nohp, 
                                     alamat = :alamat
                                WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_mesjid', $id_mesjid);
        $this->db->bind('nama_amil', $nama_amil);
        $this->db->bind('email', $email);
        $this->db->bind('nohp', $nohp);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('id_user', $id_user);
        $this->db->execute();

        return $this->db->rowCount();
    }

}