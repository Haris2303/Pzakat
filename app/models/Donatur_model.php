<?php

class Donatur_model {

    private $table = 'tb_donatur';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * ----------------------------------------------------------------------------------------------------------------
     *              GET DATA
     * --------------------------------------------------------------------------------------------------------------
     */
    
    public function getIdBankByKode(string $kode): int {
        $query = "SELECT id_bank FROM $this->table WHERE kode = :kode";
        $this->db->query($query);
        $this->db->bind('kode', $kode);
        return $this->db->single()['id_bank'];
    }

    public function checkKode(string $kode): bool {
        $query = "SELECT id_donatur FROM $this->table WHERE kode = :kode";
        $this->db->query($query);
        $this->db->bind('kode', $kode);
        return ($this->db->single()['id_donatur'] > 0) ? true : false;
    }

    public function tambahDataDonatur($data)
    {
        // initial variabel
        $slug_program   = $data['slug_program'];
        $id_user        = isset($data['id_user']) ? $data['id_user'] : null;
        $id_bank        = $data['bank'];
        $kode           = $data['key'];
        $nama_donatur   = ucwords(strtolower($data['nama-lengkap']));
        $email          = strtolower($data['email']);
        $nohp           = $data['nohp'];
        $donasi         = str_replace('.', '', $data['nominal-donasi']);
        $pesan          = htmlspecialchars($data['pesan']);

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, :id_user, :id_bank, :slug_program, :kode, :nama_donatur, :email, :nohp, :donasi, :pesan, NOW())";
        $this->db->query($query);
        $this->db->bind('id_user', $id_user);
        $this->db->bind("id_bank", $id_bank);
        $this->db->bind("slug_program", $slug_program);
        $this->db->bind("kode", $kode);
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