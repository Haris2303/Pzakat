<?php

class Kelolapembayaran_model {

    private $view = [
        "dataAll"        => "vwAllPembayaran",
        "dataPending"    => "vwPembayaranPending",
        "dataKonfirmasi" => "vwPembayaranKonfirmasi",
        "dataSukses"     => "vwPembayaranSukses",
        "dataGagal"      => "vwPembayaranGagal"
    ];
    private $table = 'tb_pembayaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataPembayaran()
    {
        $vw = $this->view['dataAll'];
        $query = "SELECT * FROM $vw";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getDataPembayaranById($id) 
    {
        $vw = $this->view['dataAll'];
        $query = "SELECT * FROM $vw WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind("id_donatur", $id);
        return $this->db->single();
    }

    public function getAllDataPembayaranPending(): array
    {
        $vw = $this->view['dataPending'];
        $query = "SELECT * FROM $vw";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataPembayaranKonfirmasi(): array
    {
        $vw = $this->view['dataKonfirmasi'];
        $query = "SELECT * FROM $vw";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataPembayaranSukses(): array
    {
        $vw = $this->view['dataSukses'];
        $query = "SELECT * FROM $vw";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataPembayaranGagal(): array
    {
        $vw = $this->view['dataGagal'];
        $query = "SELECT * FROM $vw";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * 
     * @param Aksi
     * 
     */

    public function konfirmasiPembayaran($id, $username): int
    {
        $query = "UPDATE $this->table SET username_amil = :username_amil, status_pembayaran = :status_pembayaran WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('username_amil', $username);
        $this->db->bind('status_pembayaran', 'success');
        $this->db->bind('id_donatur', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function batalkanPembayaran($id, $username): int
    {
        $query = "UPDATE $this->table SET username_amil = :username_amil, status_pembayaran = :status_pembayaran WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('username_amil', $username);
        $this->db->bind('status_pembayaran', 'failed');
        $this->db->bind('id_donatur', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusPembayaran($id): int
    {
        $query = "DELETE FROM $this->table WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('id_donatur', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

}