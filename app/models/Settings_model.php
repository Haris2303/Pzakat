<?php

class Settings_model {

    private $table = [
        'user' => 'tb_user'
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function ubahPasswordUser(string $username, array $data): int|string {
        // init variabel
        $table              = $this->table['user'];
        $password_lama      = $data['password-lama'];
        $password_baru      = $data['password-baru'];
        $password_konfirmasi= $data['password-konfirmasi'];

        // cek apakah password lama valid
        $cek = "SELECT password FROM $table WHERE username = :username";
        $this->db->query($cek);
        $this->db->bind('username', $username);
        $row = $this->db->single();
        if(!password_verify($password_lama, $row['password'])) return 'Password Salah!';

        // cek konfirmasi password
        if($password_baru !== $password_konfirmasi) return 'Password Konfirmasi Salah!';

        // cek panjang password
        if(strlen($password_baru) < 8) return 'Password harus lebih dari 8 karakter!';

        // hash password
        $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);

        // update password
        $update = "UPDATE $table SET password = :password WHERE username = :username";
        $this->db->query($update);
        $this->db->bind('password', $password_baru);
        $this->db->bind('username', $username);
        $this->db->execute();

        return $this->db->rowCount();

    }

}