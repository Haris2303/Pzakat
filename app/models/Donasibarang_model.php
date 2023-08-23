<?php

class Donasibarang_model
{

    private $table = 'tb_donasibarang';
    private $view = 'vwPembayaranBarang';
    private $db;
    private $baseModel;
    private $baseModelView;

    public function __construct()
    {
        $this->baseModel = new BaseModel($this->table);
        $this->baseModelView = new BaseModel($this->view);
        $this->db = new Database();
    }

    /**
     * -----------------------------------------------------------------------
     *                 GET ALL DATA
     * -----------------------------------------------------------------------
     */

    /**
     * Mengambil semua data pembayaran barang.
     *
     * @return array Data pembayaran barang yang ditemukan.
     */
    public function getAllDataPembayaranBarang()
    {
        $this->baseModelView->selectData();
        return $this->baseModelView->fetchAll();
    }

    /**
     * ------------------------------------------------------------------------
     *              GET DATA BY
     * ------------------------------------------------------------------------
     */

    /**
     * Mengambil data pembayaran barang berdasarkan ID.
     *
     * @param int $id ID data pembayaran barang yang akan dicari.
     * @return array|bool Data pembayaran barang yang cocok dengan ID yang diberikan, atau false jika tidak ditemukan.
     */
    public function getDataPembayaranBarangById($id): array|bool
    {
        $this->baseModel->selectData($this->view, null, [], ["id_donasibarang = " => $id]);
        return $this->baseModel->fetch();
    }

    /**
     * -------------------------------------------------------------------------
     *                 ACTION DATA
     * -------------------------------------------------------------------------
     */

    /**
     * Menambahkan data pembayaran barang baru ke dalam database.
     *
     * @param array $dataPost Data yang diperoleh dari form.
     * @param array $dataFile Data berkas yang diunggah (gambar).
     * @return int Jumlah baris yang terpengaruh oleh operasi penambahan data.
     */
    public function tambahPembayaranBarang($dataPost, $dataFile): int
    {

        // upload gambar
        $gambar = Utility::uploadImage($dataFile, 'bukti_barang');

        // cek gambar
        if (!is_string($gambar)) {
            return 'Gagal Upload Gambar, Periksa ekstensi file!';
        }

        // siapkan data insert
        $data = [
            "uuid" => Utility::generateUUID(),
            "slug_program" => $dataPost['slug-program'],
            "nama_donatur" => $dataPost['nama-donatur'],
            "email" => $dataPost['email'],
            "nohp" => $dataPost['nohp'],
            "pesan" => $dataPost['pesan'],
            "jenis_barang" => $dataPost['jenis-barang'],
            "berat_barang" => (int) $dataPost['berat-barang'],
            "bukti_barang" => $gambar,
            "datetime" => date('Y-m-d H:i:s')
        ];

        // insert data
        $rowCount = $this->baseModel->insertData($data);

        // jika data berhasil ditambahkan
        if ($rowCount > 0) {
            // update data program barang
            $query = "UPDATE tb_program SET total_dana = total_dana + :berat_barang, jumlah_donatur = jumlah_donatur + 1 WHERE slug = :slug AND jenis_pembayaran = :jenis_pembayaran";
            $this->db->query($query);
            $this->db->bind('berat_barang', $data['berat_barang']);
            $this->db->bind('slug', $data['slug_program']);
            $this->db->bind('jenis_pembayaran', 'barang');
            $this->db->execute();
        }

        return $this->db->rowCount();
    }
}
