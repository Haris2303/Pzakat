<?php

class Norek_model
{

    private $table  = 'tb_norek';
    private $baseModel;

    public function __construct()
    {
        $this->baseModel = new BaseModel($this->table);
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------------------------------------
     *                GET ALL DATA
     * -----------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mendapatkan semua data dari tabel yang memiliki saldo donasi lebih dari 0.
     *
     * @return array Data yang memenuhi kondisi saldo_donasi > 0.
     */
    public function getAllDataNorekHaveSaldo()
    {
        $this->baseModel->selectData(null, null, [], ["saldo_donasi >" => 0]);
        return $this->baseModel->fetchAll();
    }

    /**
     * Mendapatkan semua data dari tabel tanpa kondisi tertentu.
     *
     * @return array Semua data dari tabel.
     */
    public function getAllDataNorek()
    {
        $this->baseModel->selectData();
        return $this->baseModel->fetchAll();
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------------------------------------
     *                GET DATA BY
     * -----------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mendapatkan semua data dari tabel berdasarkan jenis program tertentu.
     *
     * @param string $jenis_program Jenis program yang digunakan sebagai kondisi.
     * @return array Semua data dari tabel sesuai dengan jenis program yang diberikan.
     */
    public function getAllDataNorekByProgram($jenis_program)
    {
        $this->baseModel->selectData(null, null, [], ["jenis_program =", $jenis_program]);
        return $this->baseModel->fetchAll();
    }

    /**
     * Mendapatkan data norek dari tabel berdasarkan ID tertentu.
     *
     * @param int $id ID norek yang digunakan sebagai kondisi.
     * @return array|null Data norek dari tabel sesuai dengan ID yang diberikan, atau null jika tidak ditemukan.
     */
    public function getDataNorekById($id)
    {
        $this->baseModel->selectData(null, null, [], ["id_norek =" => $id]);
        return $this->baseModel->fetch();
    }

    /**
     * ---------------------------------------------------------------------------------------------------------------------------------------------
     *                  GET DATA JSON
     * ---------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mendapatkan data bank dari file JSON dan mengembalikannya dalam bentuk array.
     *
     * @return array Data bank yang diambil dari file JSON.
     */
    public function getDataBankJsonDecode(): array
    {
        $url = BASEURL . "/static/api/bank/bank.json";
        $result = file_get_contents($url);
        return json_decode($result, true);
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------
     *                  ACTION DATA
     * --------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Menambahkan data nomor rekening baru ke dalam database.
     *
     * @param array $dataPost Data yang diterima dari formulir.
     * @return int|string Jika data berhasil ditambahkan, akan mengembalikan jumlah baris yang terpengaruh.
     *                    Jika data gagal ditambahkan, akan mengembalikan pesan error.
     */
    public function tambahDataNorek(array $dataPost): int|string
    {
        // set uppercase nama bank
        $nama_bank = strtoupper($dataPost['nama-bank']);

        // siapkan data
        $dataArray = [
            "uuid" => Utility::generateUUID(),
            "nama_pemilik" => ucwords(strtolower($dataPost['nama-pemilik'])),
            "nama_bank" => strtoupper($dataPost['nama-bank']),
            "norek" => $dataPost['norek'],
            "jenis_program" => ucwords($dataPost['jenis-program']),
            "saldo_donasi" => 0,
            "gambar" => strtolower(join('-', explode(' ', strtoupper($dataPost['nama-bank'])))) . '.jpeg',
        ];

        // cek norek
        if ($this->baseModel->isData(["norek" => $dataArray['norek']])) return 'Norek sudah tersedia!';

        // insert data
        return $this->baseModel->insertData($dataArray);
    }

    /**
     * Mengubah data nomor rekening berdasarkan ID.
     *
     * @param array $dataPost Data yang diterima dari formulir.
     * @return int|string Jika data berhasil diubah, akan mengembalikan jumlah baris yang terpengaruh.
     *                    Jika data gagal diubah, akan mengembalikan pesan error.
     */
    public function ubahDataNorek($dataPost): int|string
    {
        // init variabel
        $id_norek    = $dataPost['id'];
        $namapemilik = ucwords(strtolower($dataPost['nama-pemilik']));
        $norek       = $dataPost['norek'];

        // cek norek
        if ($this->baseModel->isData(["norek" => $norek]) && $this->baseModel->isData(["id_norek" => $id_norek])) return "Nomor rekening sudah terdaftar!";

        $data = [
            "nama_pemilik" => $namapemilik,
            "norek" => $norek
        ];

        // update data
        return $this->baseModel->updateData($data, ["id_norek" => $id_norek]);
    }

    /**
     * Menghapus data berdasarkan UUID.
     *
     * @param string $uuid UUID dari data yang akan dihapus.
     * @return int Jumlah baris yang terpengaruh setelah data dihapus.
     */
    public function deleteData($uuid): int
    {
        // delete data
        return $this->baseModel->deleteData(["UUID" => $uuid]);
    }
}
