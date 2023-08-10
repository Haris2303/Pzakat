<?php

class Kategoriprogram_model
{

    /**
     * Nama tabel dalam basis data yang akan digunakan.
     * @var string
     */
    private $table = 'tb_kategoriprogram';

    /**
     * Objek model basis data yang akan digunakan.
     * @var [tipe objek yang sesuai]
     */
    private $baseModel;

    /**
     * Konstruktor kelas yang bertanggung jawab untuk inisialisasi objek 'baseModel'.
     */
    public function __construct()
    {
        $this->baseModel = new BaseModel($this->table);
    }

    /**
     * ------------------------------------------------------------------------------------------------------------------------------------------------
     *                      GET DATA KATEGORI PROGRAM
     * ------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mengambil seluruh data kategori program dari basis data menggunakan baseModel.
     *
     * @return array Sebuah array yang berisi seluruh data kategori program yang diambil.
     */
    public function getAllDataKategoriProgram(): array
    {
        // Melakukan operasi SELECT untuk mengambil seluruh data kategori program.
        $this->baseModel->selectData();

        // Mengambil dan mengembalikan seluruh data kategori program yang diambil.
        return $this->baseModel->fetchAll();
    }


    /**
     * Mendapatkan seluruh kategori program berdasarkan status yang ditentukan.
     *
     * @param string $status Nilai status: 'aktif' atau 'pasif'. Opsional.
     * @return array Sebuah array yang berisi kategori program yang diambil.
     */
    public function getAllKategoriProgram(string $status = null): array
    {
        // Memeriksa apakah $status bernilai null atau tidak.
        // Jika $status bernilai null, ambil semua kategori program.
        // Jika $status tidak bernilai null, ambil kategori program dengan status yang ditentukan.
        (is_null($status)) ? $this->baseModel->selectData() : $this->baseModel->selectData(null, "*", [], ["status =" => $status]);

        // Mengambil dan mengembalikan semua kategori program yang diambil.
        return $this->baseModel->fetchAll();
    }

    /**
     * ----------------------------------------------------------------------------------------------------------------------------------------------------
     *              ACTION DATA KATEGORI PROGRAM
     * ----------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Menambahkan data kategori baru ke dalam database menggunakan baseModel.
     *
     * @param array $data Data yang akan ditambahkan, berisi 'username_amil' dan 'nama_kategori'.
     * @return int Jumlah baris yang terpengaruh oleh operasi INSERT.
     */
    public function tambahDataKategori($data): int
    {
        // Menyimpan data dari POST
        $username_amil = $data['username_amil'];
        $nama_kategori = $data['nama_kategori'];

        // Menyiapkan data untuk operasi INSERT menggunakan baseModel.
        $dataInsert = [
            "username_amil" => $username_amil,
            "nama_kategori" => ucwords($nama_kategori), // Mengubah huruf pertama setiap kata menjadi kapital.
            "datetime" => date('Y-m-d H:i:s')
        ];

        // Memanggil metode insertData pada baseModel untuk menambahkan data.
        return $this->baseModel->insertData($dataInsert);
    }

    /**
     * Menghapus data kategori berdasarkan ID menggunakan baseModel.
     *
     * @param int $id ID kategori yang akan dihapus.
     * @return int Jumlah baris yang terpengaruh oleh operasi DELETE.
     */
    public function hapusDataKategori($id): int
    {
        // Memanggil metode deleteData pada baseModel untuk menghapus data berdasarkan ID.
        return $this->baseModel->deleteData(["id_kategori_program" => $id]);
    }

    /**
     * Mengubah status program kategori berdasarkan ID menggunakan baseModel.
     *
     * @param int $id ID program kategori yang akan diubah statusnya.
     * @param string $status Status baru yang akan diberikan.
     * @return int Jumlah baris yang terpengaruh oleh operasi UPDATE.
     */
    public function ubahStatusProgram(int $id, string $status): int
    {
        // Memanggil metode updateData pada baseModel untuk mengubah status program kategori berdasarkan ID.
        return $this->baseModel->updateData(["status" => $status], ["id_kategoriprogram" => $id]);
    }
}
