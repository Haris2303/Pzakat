<?php

class Kelolapembayaran_model {

    private $view = [
        "dataAll"        => "vwAllPembayaran",
        "dataPending"    => "vwPembayaranPending",
        "dataKonfirmasi" => "vwPembayaranKonfirmasi",
        "dataSukses"     => "vwPembayaranSukses",
        "dataGagal"      => "vwPembayaranGagal",
        "dataBarang"     => "vwPembayaranBarang"
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

    /**
     * 
     * @method Pembayaran Barang
     * 
     */

    public function getAllDataPembayaranBarang()
    {
        $vw = $this->view['dataBarang'];
        $query = "SELECT * FROM $vw";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * 
     * @method Pembayaran Tunai
     * 
     */

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
     * @method Aksi Pembayaran Tunai
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

    /**
     * 
     * @method CRUD pembayaran barang
     * 
     */
    public function tambahPembayaranBarang($data): int 
    {
        // donatur
        $slug_program   = $data['slug-program'];
        $nama_donatur   = $data['nama-donatur'];
        $email          = $data['email'];
        $nohp           = $data['nohp'];
        $pesan          = $data['pesan'];
        $donasi         = $data['berat-barang'];
        $key            = NULL;
        $id_bank        = NULL;

        // insert data
        $tb_donatur = $this->table['donatur'];
        $query = "INSERT INTO $tb_donatur VALUES(NULL, :id_bank, :slug_program, :key, :nama_donatur, :email, :nohp, :donasi, :pesan, NOW())";
        $this->db->query($query);
        $this->db->bind('id_bank', $id_bank);
        $this->db->bind('slug_program', $slug_program);
        $this->db->bind('key', $key);
        $this->db->bind('nama_donatur', $nama_donatur);
        $this->db->bind('email', $email);
        $this->db->bind('nohp', $nohp);
        $this->db->bind('donasi', $donasi);
        $this->db->bind('pesan', $pesan);
        $this->db->execute();

        return $this->db->rowCount();
    }

}