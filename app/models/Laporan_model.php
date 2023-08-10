<?php

class Laporan_model
{

    /**
     * Nama tabel dalam basis data untuk data laporan.
     * @var string
     */
    private $table = 'tb_laporan';

    /**
     * Nama tampilan dalam basis data untuk data laporan.
     * @var string
     */
    private $view = 'vwAllLaporan';

    /**
     * Objek model basis data untuk data laporan.
     * @var [tipe objek yang sesuai]
     */
    private $baseModel;

    /**
     * Objek model basis data untuk tampilan data laporan.
     * @var [tipe objek yang sesuai]
     */
    private $modelView;

    /**
     * Konstruktor kelas yang menginisialisasi objek model basis data.
     */
    public function __construct()
    {
        // Menginisialisasi objek 'baseModel' untuk data laporan dan tampilan data laporan.
        $this->baseModel = new BaseModel($this->table);
        $this->modelView = new BaseModel($this->view);
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------------------------------------------------
     *                      GET DATA TABLE
     * -----------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mengambil data dari basis data menggunakan baseModel.
     *
     * @return array Sebuah array yang berisi data yang diambil dari basis data.
     */
    public function getData(): array
    {
        // Melakukan operasi SELECT data dari basis data dengan urutan berdasarkan ID laporan secara menurun (DESC).
        $this->baseModel->selectData(null, null, ["id_laporan" => "DESC"]);

        // Mengambil dan mengembalikan seluruh data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil data laporan dengan batasan jumlah berdasarkan limit tertentu dari basis data menggunakan baseModel.
     *
     * @param int $limit Batasan jumlah data yang akan diambil.
     * @return array Sebuah array yang berisi data laporan yang diambil dengan batasan jumlah tertentu.
     */
    public function getDataLimit(int $limit): array
    {
        // Melakukan operasi SELECT data dari basis data dengan urutan berdasarkan ID laporan secara menurun (DESC) dan batasan jumlah.
        $this->baseModel->selectData(null, null, ["id_laporan" => "DESC"], null, "LIMIT " . $limit);

        // Mengambil dan mengembalikan seluruh data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }


    /**
     * --------------------------------------------------------------------------------------------------------------------------------------------------------------
     *                       GET DATA VIEW
     * --------------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mengambil data laporan berdasarkan jenis program dan jenis pembayaran yang ditentukan.
     *
     * @method getLaporan (Mengambil data laporan bisa semua data atau data yang ditentukan)
     * @param string|null $jenis_program Jenis program yang akan diambil. Nilai dapat berupa NULL, 'Zakat', 'Infaq', 'Donasi', 'Qurban', atau 'Ramadhan'.
     * @param string|null $jenis_pembayaran Jenis pembayaran yang akan diambil. Nilai dapat berupa NULL, 'Tunai', atau 'Barang'.
     * @return array Sebuah array yang berisi data laporan yang diambil berdasarkan jenis program dan jenis pembayaran.
     */
    public function getLaporan(string $jenis_program = null, string $jenis_pembayaran = null): array
    {
        // set jenis_program jadi kapital dan jenis pembayaran lowercase
        ucwords($jenis_program);
        strtolower($jenis_pembayaran);

        // jika tidak ada argument yang diberikan
        if (is_null($jenis_program) && is_null($jenis_pembayaran)) $this->modelView->selectData();

        // jika argument jenis_program tidak null
        if (!is_null($jenis_program)) $this->modelView->selectData(null, null, [], ["jenis_program =" => $jenis_program]);

        // jika argument jenis_pembayaran tidak null
        if (!is_null($jenis_pembayaran)) $this->modelView->selectData(null, null, [], ["jenis_pembayaran =" => $jenis_pembayaran]);

        // jika 2 argument tidak null
        if (!is_null($jenis_program) && !is_null($jenis_pembayaran)) $this->modelView->selectData(null, null, [], ["logic" => "AND", "jenis_program =" => $jenis_program, "jenis_pembayaran =" => $jenis_pembayaran]);

        return $this->modelView->fetchAll();
    }

    /**
     * ------------------------------------------------------------------------------------------------------------------------------------------------------------
     *                    ACTION DATA
     * ------------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Menambahkan data laporan ke dalam basis data.
     *
     * @param array $data Array yang berisi data yang akan ditambahkan.
     * @return int|string Jumlah baris yang terpengaruh oleh operasi INSERT atau pesan kesalahan jika terjadi.
     */
    public function tambahData(array $data): int|string
    {
        // Inisialisasi variabel
        $tahun      = $data['tahun'];
        $link       = $data['link'];
        $deskripsi  = $data['deskripsi'];
        $uuid       = Utility::generateUUID();

        // Memeriksa apakah panjang tahun valid
        if (strlen($tahun) > 4 || strlen($tahun) < 4) return 'Panjang tahun tidak valid!';

        // Menyiapkan data yang akan ditambahkan
        $dataArray = [
            "uuid" => $uuid,
            "link" => $link,
            "deskripsi" => $deskripsi,
            "tahun" => $tahun,
            "created_at" => date('Y-m-d H:i:s')
        ];

        // Memeriksa apakah tahun sudah ada dalam basis data
        if ($this->baseModel->isData(["tahun" => $tahun])) return 'Tahun ' . $tahun . ' Sudah Ditambahkan!';

        // Memeriksa apakah link sudah ada dalam basis data
        if ($this->baseModel->isData(["link" => $link])) return 'link ' . $link . ' Sudah Ditambahkan!';

        // Menambahkan data ke dalam basis data
        return $this->baseModel->insertData($dataArray);
    }

    /**
     * Menghapus data laporan dari basis data berdasarkan UUID.
     *
     * @param string $uuid UUID dari data laporan yang akan dihapus.
     * @return int Jumlah baris yang terpengaruh oleh operasi DELETE.
     */
    public function deleteData(string $uuid): int
    {
        // Menghapus data laporan dari basis data berdasarkan UUID
        return $this->baseModel->deleteData(["UUID" => $uuid]);
    }
}
