<?php

class Laporantahunan_model {

    private $db;
    private $table = 'tb_laporan';

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getData(): array {
        $query = "SELECT * FROM $this->table ORDER BY id_laporan DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------
     *                  GET DATA LIMIT
     * -------------------------------------------------------------------------------------------------------------------------
     */
    public function getDataLimit(int $limit): array {
        $query = "SELECT * FROM $this->table ORDER BY id_laporan DESC LIMIT :lim";
        $this->db->query($query);
        $this->db->bind('lim', $limit);
        return $this->db->resultSet();
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------
     *                  ACTION > INSERT | DELETE 
     * -------------------------------------------------------------------------------------------------------------------------
     */

    public function tambahData(array $data): int|string {
        // init variabel
        $tahun      = $data['tahun'];
        $link       = $data['link'];
        $deskripsi  = $data['deskripsi'];
        $uuid       = Utility::generateUUID();

        // cek tahun valid
        if(strlen($tahun) > 4 || strlen($tahun) < 4) return 'Panjang tahun tidak valid!';

        // cek tahun available in database
        $cekTahun = "SELECT tahun FROM $this->table WHERE tahun = :tahun";
        $this->db->query($cekTahun);
        $this->db->bind('tahun', $tahun);
        if(!is_bool($this->db->single())) return 'Tahun ' . $tahun . ' Sudah Ditambahkan!';

        // cek link available
        $ceklink = "SELECT link FROM $this->table WHERE link = :link";
        $this->db->query($ceklink);
        $this->db->bind('link', $link);
        if(!is_bool($this->db->single())) return 'link ' . $link . ' Sudah Ditambahkan!';

        // insert data
        $insert = "INSERT INTO $this->table VALUES(NULL, :uuid, :link, :deskripsi, :tahun, NOW())";
        $this->db->query($insert);
        $this->db->bind('uuid', $uuid);
        $this->db->bind('link', $link);
        $this->db->bind('deskripsi', $deskripsi);
        $this->db->bind('tahun', $tahun);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteData(string $uuid): int {
        $query = "DELETE FROM $this->table WHERE UUID = :uuid";
        $this->db->query($query);
        $this->db->bind('uuid', $uuid);
        $this->db->execute();
        return $this->db->rowCount();
    }

}