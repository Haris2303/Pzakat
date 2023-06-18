<?php

class Donatur_model {

    private $table = 'tb_donatur';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function tambahDataDonatur($data)
    {
        // initial variabel
        $slug_program   = $data['slug_program'];
        $id_bank        = $data['bank'];
        $key            = $data['key'];
        $nama_donatur   = ucwords(strtolower($data['nama-lengkap']));
        $email          = strtolower($data['email']);
        $nohp           = $data['nohp'];
        $donasi         = str_replace('.', '', $data['nominal-donasi']);
        $pesan          = htmlspecialchars($data['pesan']);

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, :id_bank, :slug_program, :key, :nama_donatur, :email, :nohp, :donasi, :pesan, NOW())";
        $this->db->query($query);
        $this->db->bind("id_bank", $id_bank);
        $this->db->bind("slug_program", $slug_program);
        $this->db->bind("key", $key);
        $this->db->bind('nama_donatur', $nama_donatur);
        $this->db->bind('email', $email);
        $this->db->bind('nohp', $nohp);
        $this->db->bind('donasi', $donasi);
        $this->db->bind('pesan', $pesan);
        $this->db->execute();

        // set cookie
        $expiringTime = time() + (24 * 3600);
        setcookie('nominal-donasi', $donasi, $expiringTime);
        setcookie('id-bank', $id_bank, $expiringTime);

        return $this->db->rowCount();

    }

}