<?php

class Profile_model extends Controller {

    private $table = [
        'amil' => 'tb_amil',
        'admin' => 'tb_admin'
    ];
    private $db;

    protected $controller;

    public function __construct()
    {
        $this->db = new Database();
        $this->controller = new Controller();
    }

    public function updateUsername(string $id_user, string $username): int|string {
        // cek username di database
        $cek = "SELECT username FROM tb_user WHERE username = :username";
        $this->db->query($cek);
        $this->db->bind('username', $username);
        if(!is_bool($this->db->single())) return 'Username sudah terdaftar!';

        // update username
        $update = "UPDATE tb_user SET username = :username_baru WHERE id_user = :id_user";
        $this->db->query($update);
        $this->db->bind('username_baru', $username);
        $this->db->bind('id_user', $id_user);
        $this->db->execute();
        
        // set session username 
        $_SESSION['username'] = $username;

        return $this->db->rowCount();
    }

    public function ubahProfilAdmin(array $data, string $username): int|string {
        // init variabel
        $table          = $this->table['admin'];
        $nama           = $data['nama'];
        $username_baru  = strtolower($data['username']);

        // get id user
        $id_user = $this->controller->model('User_model')->getIdByUsername($username);

        // update nama
        $update = "UPDATE $table SET nama = :nama WHERE id_user = :id_user";
        $this->db->query($update);
        $this->db->bind('nama', $nama);
        $this->db->bind('id_user', $id_user);
        $this->db->execute();
        $rowCount = $this->db->rowCount();

        // set session nama
        $_SESSION['nama'] = $nama;

        // jika username diubah
        if($username_baru !== $username) { 
            $isUpdate = $this->updateUsername($id_user, $username_baru);
            if(is_string($isUpdate)) return $isUpdate; else $rowCount = $isUpdate;
        }

        return $rowCount;
    }

    public function ubahProfilAmil(array $data, string $username): int|string {
        // init variabel
        $table          = $this->table['amil'];
        $nama           = $data['nama'];
        $username_baru  = strtolower($data['username']);
        $email          = $data['email'];
        $nohp           = $data['nohp'];
        $id_mesjid      = (int) $data['id_mesjid'];
        $alamat         = $data['alamat'];

        // get id user by username
        $id_user = $this->controller->model('User_model')->getIdByUsername($username);

        // cek email input in database
        if($this->controller->model('User_model')->isEmail($email, $id_user)) return 'Email sudah terdaftar!';

        // ubah data
        $query = "UPDATE $table SET id_mesjid = :id_mesjid,
                                     nama = :nama_amil, 
                                     email = :email, 
                                     nohp = :nohp, 
                                     alamat = :alamat
                                WHERE id_user = :id_user";
        $this->db->query($query);
        $this->db->bind('id_mesjid', $id_mesjid);
        $this->db->bind('nama_amil', $nama);
        $this->db->bind('email', $email);
        $this->db->bind('nohp', $nohp);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('id_user', $id_user);
        $this->db->execute();
        $rowCount = $this->db->rowCount();

        // set session nama
        $_SESSION['nama'] = $nama;

        // jika username diubah
        if($username_baru !== $username) { 
            $isUpdate = $this->updateUsername($id_user, $username_baru);
            if(is_string($isUpdate)) return $isUpdate; else $rowCount = $isUpdate;
        }

        return $rowCount;
    }

}