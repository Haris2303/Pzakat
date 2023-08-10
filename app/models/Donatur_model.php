<?php

class Donatur_model
{

    private $table = 'tb_donatur';
    private $baseModel;

    public function __construct()
    {
        $this->baseModel = new BaseModel($this->table);
    }

    /**
     * ----------------------------------------------------------------------------------------------------------------
     *              GET DATA
     * --------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mengambil semua data dari tabel.
     *
     * @return array Array berisi semua data yang ada dalam tabel.
     */
    public function getAllData(): array
    {
        $this->baseModel->selectData();
        return $this->baseModel->fetchAll();
    }

    /**
     * ---------------------------------------------------------------------------------------------------------------------------------------------------------
     *                      GET DATA BY
     * ---------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mendapatkan ID bank berdasarkan kode bank yang diberikan.
     *
     * @param string $kode Kode bank yang dicari.
     * @return int ID bank yang ditemukan.
     */
    public function getIdBankByKode(string $kode): int
    {
        // Melakukan operasi SELECT pada database menggunakan baseModel dengan kondisi kode bank.
        $this->baseModel->selectData(null, null, [], ["kode =" => $kode]);

        // Mengambil nilai 'id_bank' dari hasil yang diambil.
        return $this->baseModel->fetch()['id_bank'];
    }

    /**
     * Memeriksa apakah kode tertentu sudah ada dalam database.
     *
     * @param string $kode Kode yang akan diperiksa.
     * @return bool True jika kode sudah ada, false jika tidak.
     */
    public function checkKode(string $kode): bool
    {
        return $this->baseModel->isData(["kode" => $kode]);
    }

    /**
     * Menambahkan data donatur baru ke dalam database.
     *
     * @param array $data Data donatur yang akan ditambahkan.
     * @return int Jumlah baris yang terpengaruh oleh operasi penambahan data.
     */
    public function tambahData(array $data): int
    {
        // initial variabel
        $slug_program   = $data['slug_program'];
        $id_user        = isset($data['id_user']) ? $data['id_user'] : null;
        $id_bank        = $data['bank'];
        $kode           = $data['key'];
        $nama_donatur   = ucwords(strtolower($data['nama-lengkap']));
        $email          = strtolower($data['email']);
        $nohp           = $data['nohp'];
        $donasi         = str_replace('.', '', $data['nominal-donasi']);
        $pesan          = htmlspecialchars($data['pesan']);
        $uuid           = Utility::generateUUID();

        // siapkan data
        $dataArray = [
            "UUID" => $uuid,
            "id_user" => $id_user,
            "id_bank" => $id_bank,
            "slug_program" => $slug_program,
            "kode" => $kode,
            "nama_donatur" => $nama_donatur,
            "email" => $email,
            "nohp" => $nohp,
            "donasi" => $donasi,
            "pesan" => $pesan,
            "datetime" => date('Y-m-d H:i:s')
        ];

        // insert data
        $rowCount = $this->baseModel->insertData($dataArray);

        // set cookie
        $expiringTime = time() + (24 * 3600);
        setcookie('nominal-donasi', $donasi, $expiringTime);
        setcookie('id-bank', $id_bank, $expiringTime);

        return $rowCount;
    }

    /**
     * Menghapus data donatur berdasarkan ID donatur.
     *
     * @param int $id_donatur ID donatur yang akan dihapus.
     * @return int Jumlah baris yang terpengaruh oleh operasi penghapusan data.
     */
    public function hapusData(int $id_donatur): int
    {
        return $this->baseModel->deleteData(["id_donatur" => $id_donatur]);
    }
}
