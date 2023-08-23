<?php

class Banner_model
{

    private $table = 'tb_banner';
    private $baseModel;

    public function __construct()
    {
        $this->baseModel = new BaseModel($this->table);
    }

    /**
     * ---------------------------------------------------------------
     *                  GET ALL DATA
     * ---------------------------------------------------------------
     */

    /**
     * Mengambil semua data banner.
     *
     * @return array Data banner yang ditemukan.
     */
    public function getAllDataBanner(): array
    {
        $this->baseModel->selectData();
        return $this->baseModel->fetchAll();
    }

    /**
     * -----------------------------------------------------------------
     *              ACTION DATA
     * -----------------------------------------------------------------
     */

    /**
     * Menambahkan data banner baru.
     *
     * @param array $dataPost Data dari permintaan POST.
     * @param array $dataFile Data berkas gambar yang diunggah.
     * @return string|int Pesan kesalahan atau hasil operasi penambahan data.
     */
    public function tambahDataBanner($dataPost, $dataFile)
    {
        // uplode gambar
        $gambar = Utility::uploadImage($dataFile, 'banner');

        // cek gambar
        $inValidMsg = 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';
        if (!is_string($gambar)) {
            return $inValidMsg;
        }

        // siapkan data
        $dataBanner = [
            "username" => $dataPost['username_amil'],
            "gambar" => $gambar,
            "link" => $dataPost['link'],
            "datetime" => date('Y-m-d H:i:s')
        ];

        // insert data
        return $this->baseModel->insertData($dataBanner);
    }

    /**
     * Menghapus data banner berdasarkan UUID.
     *
     * @param string $uuid UUID banner yang akan dihapus.
     * @return int Jumlah baris yang terpengaruh oleh operasi penghapusan.
     */
    public function deleteData(string $uuid): int
    {
        return $this->baseModel->deleteData(["UUID" => $uuid]);
    }
}
