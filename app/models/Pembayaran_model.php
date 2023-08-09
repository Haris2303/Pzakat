<?php

class Pembayaran_model {

    private $view = [
        "dataAll"        => "vwAllPembayaran",
        "dataPending"    => "vwPembayaranPending",
        "dataKonfirmasi" => "vwPembayaranKonfirmasi",
        "dataSukses"     => "vwPembayaranSukses",
        "dataGagal"      => "vwPembayaranGagal",
        "pemasukkanBulanan" => "vwPemasukkanBulanan",
        "pemasukkanHarian"  => "vwPemasukkanHarian"
    ];
    private $table = 'tb_pembayaran';
    private $db;
    private $baseModel;
    private $modelDonatur;

    public function __construct()
    {
        $this->db = new Database();
        $this->baseModel = new BaseModel($this->table);
        $this->modelDonatur = new BaseModel('tb_donatur');
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
     * @method GetDataBy
     * 
     */

    public function getDataPembayaranById($id): array|bool
    {
        $vw = $this->view['dataAll'];
        $query = "SELECT * FROM $vw WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind("id_donatur", $id);
        return $this->db->single();
    }

    /**
     * -------------------------------------------------------------------------------------------------------------
     *                  GET DATA
     * -------------------------------------------------------------------------------------------------------------
     */
    
    /** 
     * @param string{status_pembayaran} value default null | pending|konfirmasi|failed|success
     * @param string{where} value default null | field
     * @param string{value} value default null | value pada field
     */
    public function getDataPembayaran(string $status_pembayaran = null, string $where = null, string $value = null): array|bool {
        $view = $this->view['dataAll'];
        $query = "SELECT * FROM $view";
        if(!is_null($status_pembayaran) && !is_null($where) || !is_null($value)) $query .= " WHERE (status_pembayaran = '$status_pembayaran' AND $where = '$value') ORDER BY tanggal_pembayaran DESC";
        elseif(!is_null($status_pembayaran)) $query .= " WHERE status_pembayaran = '$status_pembayaran' ORDER BY tanggal_pembayaran DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // get data donatur terdaftar, dimana yang diambil hanyalah donatur yang mendaftar dan sudah sukses berdonasi
    public function getDonaturTerdaftar(): int {
        $this->baseModel->selectData(null, "COUNT(DISTINCT(id_user)) AS id_user", [], ["logic" => "AND", "status_pembayaran = " => "success", "id_user <> " => 0]);
        return $this->baseModel->fetch()['id_user'];
        // $table = $this->table['pembayaran'];
        // $query = "SELECT COUNT(DISTINCT(id_user)) AS 'id_user' FROM $table WHERE (status_pembayaran = :status_pembayaran AND id_user <> :id_user)";
        // $this->db->query($query);
        // $this->db->bind('status_pembayaran', 'success');
        // $this->db->bind('id_user', 0);
        // return $this->db->single()['id_user'];
    }


    /**
     * Pemasukkan
     * @method GET DATA
     * @param NULL
     */
    public function getDataPemasukkanBulanan(): array {
        $view = $this->view['pemasukkanBulanan'];
        $query1 = "SELECT * FROM $view";
        $this->db->query($query1);
        $result = $this->db->resultSet();

        return $result;
    }

    public function getDataPemasukkanHarian(): array {
        $view = $this->view['pemasukkanHarian'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * 
     * @method Aksi Pembayaran Tunai
     * 
     */

    public function konfirmasiPembayaran($slug, $id, $username, $jumlah_dana, $nama_bank): int
    {
        $dataPembayaran = [
            "username_amil" => $username,
            "status_pembayaran" => 'success',
        ];
        $rowCount = $this->baseModel->updateData($dataPembayaran, ["id_donatur" => $id]);

        // tambah jumlah donasi
        $tb_program = 'tb_program';
        $query = "UPDATE $tb_program SET total_dana = total_dana + $jumlah_dana, jumlah_donatur = jumlah_donatur + 1 WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        $this->db->execute();

        // tambah jumlah saldo_donasi pada rekening
        $tb_norek = 'tb_norek';
        $nama_bank = join(' ', explode('-', $nama_bank));
        $query = "UPDATE $tb_norek SET saldo_donasi = saldo_donasi + $jumlah_dana WHERE nama_bank = :nama_bank";
        $this->db->query($query);
        $this->db->bind('nama_bank', $nama_bank);
        $this->db->execute();

        return $rowCount;
    }

    public function batalkanPembayaran($id, $username): int
    {
        $data = [
            "username_amil" => $username,
            "status_pembayaran" => 'failed',
        ];
        return $this->baseModel->updateData($data, ["id_donatur" => $id]);
    }

    public function hapusPembayaran($id): int
    {
        // delete data pembayaran
        $rowCount = $this->baseModel->deleteData(["id_doantur" => $id]);

        // delete data donatur by id_donatur
        $rowCount = $this->modelDonatur->deleteData(["id_donatur" => $id]);
        
        return $rowCount;
    }

}