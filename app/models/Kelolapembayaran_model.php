<?php

class Kelolapembayaran_model {

    private $view = [
        "dataAll"        => "vwAllPembayaran",
        "dataPending"    => "vwPembayaranPending",
        "dataKonfirmasi" => "vwPembayaranKonfirmasi",
        "dataSukses"     => "vwPembayaranSukses",
        "dataGagal"      => "vwPembayaranGagal",
        "dataBarang"     => "vwPembayaranBarang",
        "pemasukkanBulanan" => "vwPemasukkanBulanan",
        "pemasukkanHarian"  => "vwPemasukkanHarian"
    ];
    private $table = [
        'pembayaran' => 'tb_pembayaran',
        'donatur'    => 'tb_donatur',
        'donasibarang' => 'tb_donasibarang'
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

    public function getDataPembayaranById($id): array
    {
        $vw = $this->view['dataAll'];
        $query = "SELECT * FROM $vw WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind("id_donatur", $id);
        return $this->db->single();
    }

    public function getDataPembayaranBarangById($id): array
    {
        $vw = $this->view['dataBarang'];
        $query = "SELECT * FROM $vw WHERE id_donasibarang = :id_donasibarang";
        $this->db->query($query);
        $this->db->bind('id_donasibarang', $id);
        return $this->db->single();
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
        $tb_pembayaran = $this->table['pembayaran'];
        $query = "UPDATE $tb_pembayaran SET username_amil = :username_amil, status_pembayaran = :status_pembayaran WHERE id_donatur = :id_donatur";
        $this->db->query($query);
        $this->db->bind('username_amil', $username);
        $this->db->bind('status_pembayaran', 'success');
        $this->db->bind('id_donatur', $id);
        $this->db->execute();
        $rowCount = $this->db->rowCount();

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
    public function tambahPembayaranBarang($dataPost, $dataFile): int 
    {
        // donatur
        $slug_program   = $dataPost['slug-program'];
        $nama_donatur   = $dataPost['nama-donatur'];
        $email          = $dataPost['email'];
        $nohp           = $dataPost['nohp'];
        $pesan          = $dataPost['pesan'];
        $berat_barang   = (int)$dataPost['berat-barang'];
        $jenis_barang   = $dataPost['jenis-barang'];
        $gambar         = Utility::uploadImage($dataFile, 'bukti_barang');

        // cek gambar
        if(!is_string($gambar)) return 'Gagal Upload Gambar, Periksa ekstensi file!';

        // insert data
        $tb_donatur = $this->table['donasibarang'];
        $query = "INSERT INTO $tb_donatur VALUES(NULL, :slug_program, :nama_donatur, :email, :nohp, :pesan, :jenis_barang, :berat_barang, :bukti_barang, NOW())";
        $this->db->query($query);
        $this->db->bind('slug_program', $slug_program);
        $this->db->bind('nama_donatur', $nama_donatur);
        $this->db->bind('email', $email);
        $this->db->bind('nohp', $nohp);
        $this->db->bind('pesan', $pesan);
        $this->db->bind('jenis_barang', $jenis_barang);
        $this->db->bind('berat_barang', $berat_barang);
        $this->db->bind('bukti_barang', $gambar);
        $this->db->execute();

        // jika data berhasil ditambahkan
        if($this->db->rowCount() > 0) {
            // update data program barang
            $query = "UPDATE tb_program SET total_dana = total_dana + :berat_barang, jumlah_donatur = jumlah_donatur + 1 WHERE slug = :slug AND jenis_pembayaran = :jenis_pembayaran";
            $this->db->query($query);
            $this->db->bind('berat_barang', $berat_barang);
            $this->db->bind('slug', $slug_program);
            $this->db->bind('jenis_pembayaran', 'barang');
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

}