<?php

class Kelolapembayaran_model {

    private $view = [
        "dataAll"        => "vwAllPembayaran",
        "dataPending"    => "vwPembayaranPending",
        "dataKonfirmasi" => "vwPembayaranKonfirmasi",
        "dataSukses"     => "vwPembayaranSukses",
        "dataGagal"      => "vwPembayaranGagal"
    ];
    private $table = [
        'pembayaran' => 'tb_pembayaran',
        'donatur'    => 'tb_donatur'
    ];
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

    public function konfirmasiPembayaran($slug, $id, $username, $jumlah_dana): int
    {
        $tb_pembayaran = $this->table['pembayaran'];
        $query = "UPDATE $tb_pembayaran SET username_amil = :username_amil, status_pembayaran = :status_pembayaran WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('username_amil', $username);
        $this->db->bind('status_pembayaran', 'success');
        $this->db->bind('id_donatur', $id);
        $this->db->execute();
        $rowCount = $this->db->rowCount();

        // sum jumlah donasi
        $tb_program = 'tb_program';
        $query = "UPDATE $tb_program SET total_dana = total_dana + $jumlah_dana, jumlah_donatur = jumlah_donatur + 1 WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        $this->db->execute();

        return $rowCount;
    }

    public function batalkanPembayaran($id, $username): int
    {
        $tb_pembayaran = $this->table['pembayaran'];
        $query = "UPDATE $tb_pembayaran SET username_amil = :username_amil, status_pembayaran = :status_pembayaran WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('username_amil', $username);
        $this->db->bind('status_pembayaran', 'failed');
        $this->db->bind('id_donatur', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusPembayaran($id): int
    {

        $tb_pembayaran = $this->table['pembayaran'];
        $tb_donatur    = $this->table['donatur'];

        $query = "DELETE FROM $tb_pembayaran WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('id_donatur', $id);
        $this->db->execute();

        $query = "DELETE FROM $tb_donatur WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('id_donatur', $id);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

}