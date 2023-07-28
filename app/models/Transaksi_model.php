<?php

class Transaksi_model {

    private $table = 'tb_pembayaran';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Get Kode Pembayaran
    public function setCookieKodePembayaran()
    {
        // set cookie
        $expiringTime = time() + (24 * 3600);
        setcookie('kode-pembayaran', "KDA-".time(), $expiringTime);
    }

    public function konfirmasiDataTransaksi($dataPost, $dataFile)
    {
        $nomor_pembayaran   = $dataPost['nomor-pembayaran'];
        $kode                = $dataPost['key'];
        $jumlah_pembayaran  = str_replace('.', '', $dataPost['nominal-donasi']);
        $gambar             = Utility::uploadImage($dataFile, 'bukti_pembayaran');

        // // cek gambar
        if(!is_string($gambar)) return 'Gagal upload gambar!';

        // get id pembayaran
        $getIDPembayaran = "SELECT id_pembayaran FROM $this->table WHERE nomor_pembayaran = :kode";
        $this->db->query($getIDPembayaran);
        $this->db->bind('kode', $kode);
        $id_pembayaran = $this->db->single()['id_pembayaran'];

        // update data
        $query = "UPDATE $this->table SET 
                        nomor_pembayaran = :nomor_pembayaran, 
                        jumlah_pembayaran = :jumlah_pembayaran, 
                        bukti_pembayaran = :bukti_pembayaran,
                        tanggal_pembayaran = NOW(),
                        status_pembayaran = :status_pembayaran
                    WHERE id_pembayaran = :id_pembayaran";

        $this->db->query($query);
        $this->db->bind('id_pembayaran', $id_pembayaran);
        $this->db->bind('nomor_pembayaran', $nomor_pembayaran);
        $this->db->bind('jumlah_pembayaran', $jumlah_pembayaran);
        $this->db->bind('bukti_pembayaran', $gambar);
        $this->db->bind('status_pembayaran', 'konfirmasi');
        $this->db->execute();

        // jika konfirmasi pembayaran berhasil
        if($this->db->rowCount() > 0) {
            // update kode lama ke kode baru
            $kode_new = Utility::getKeyRandom();
            $update_kode = "UPDATE tb_donatur SET kode = :kode_new WHERE kode = :kode_old";
            $this->db->query($update_kode);
            $this->db->bind('kode_new', $kode_new);
            $this->db->bind('kode_old', $kode);
            $this->db->execute();

            return $this->db->rowCount();
        }

    }

}