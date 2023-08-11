<?php

class Pembayaran_model
{

    /**
     * Properti yang menyimpan daftar nama view yang akan digunakan dalam model.
     * Key merupakan alias dan value adalah nama view sebenarnya.
     */
    private $view = [
        "dataAll"            => "vwAllPembayaran",
        "pemasukkanBulanan"  => "vwPemasukkanBulanan",
        "pemasukkanHarian"   => "vwPemasukkanHarian"
    ];

    /**
     * Properti yang menyimpan nama tabel yang akan digunakan dalam model.
     */
    private $table = 'tb_pembayaran';

    /**
     * Properti yang menyimpan objek database untuk operasi database.
     */
    private $db;

    /**
     * Properti yang menyimpan objek model dasar untuk operasi pada tabel pembayaran.
     */
    private $baseModel;

    /**
     * Properti yang menyimpan objek model dasar untuk operasi pada tabel donatur.
     */
    private $modelDonatur;

    /**
     * Konstruktor kelas, melakukan inisialisasi objek database dan model dasar.
     */
    public function __construct()
    {
        // Inisialisasi objek database.
        $this->db = new Database();

        // Inisialisasi objek model dasar untuk tabel pembayaran.
        $this->baseModel = new BaseModel($this->table);

        // Inisialisasi objek model dasar untuk tabel donatur.
        $this->modelDonatur = new BaseModel('tb_donatur');
    }

    /**
     * --------------------------------------------------------------------------------------------------------------------------------------------------------
     *                      GET DATA
     * --------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Mengambil data pembayaran berdasarkan status pembayaran tertentu atau semua data jika status_pembayaran tidak ditentukan.
     *
     * @param string|null $status_pembayaran Status pembayaran yang ingin diambil datanya. Default: null.
     * @param array $orderby Urutan pengurutan data. Default: array().
     * @param array|null $kondisi Kondisi tambahan untuk seleksi data. Default: null.
     * @return array Array yang berisi data pembayaran yang sesuai dengan status pembayaran atau semua data pembayaran.
     */
    public function getAllDataPembayaran(string $status_pembayaran = null, array $orderby = [], array $kondisi = null): array
    {
        $vw = $this->view['dataAll']; // Nama tampilan data pembayaran.

        
        if (is_null($status_pembayaran)) {
            // Jika status_pembayaran tidak ditentukan, ambil semua data pembayaran.
            $this->baseModel->selectData($vw);
        } else if(!is_null($status_pembayaran)) {
            // Jika status_pembayaran ditentukan, ambil data pembayaran dengan status tertentu.
            $this->baseModel->selectData($vw, null, [], ["status_pembayaran =" => $status_pembayaran]);
        } else {
            // Jika status_pembayaran ada dan parameter lain
            $this->baseModel->selectData($vw, null, $orderby, $kondisi);
        }

        // Mengembalikan array berisi data pembayaran yang sesuai.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil data pembayaran berdasarkan ID donatur.
     *
     * @param int $id ID donatur yang ingin diambil datanya.
     * @return array|bool Array yang berisi data pembayaran sesuai dengan ID donatur, atau false jika tidak ditemukan.
     */
    public function getDataPembayaranById($id): array|bool
    {
        $vw = $this->view['dataAll']; // Nama tampilan data pembayaran.

        // Mengambil data pembayaran dengan mengatur filter berdasarkan ID donatur.
        $this->baseModel->selectData($vw, null, [], ["id_donatur =" => $id]);

        // Mengembalikan array yang berisi data pembayaran sesuai dengan ID donatur, atau false jika tidak ditemukan.
        return $this->baseModel->fetch();
    }

    /**
     * Mengambil jumlah donatur terdaftar yang telah berhasil berdonasi.
     *
     * @return int Jumlah donatur terdaftar yang telah berhasil berdonasi.
     */
    public function getDonaturTerdaftar(): int
    {
        $this->baseModel->selectData(
            null,
            "COUNT(DISTINCT(id_user)) AS id_user",
            [], // Tidak ada kondisi tambahan
            [
                "logic" => "AND",
                "status_pembayaran = " => "success", // Hanya data dengan status pembayaran sukses yang dihitung
                "id_user <> " => 0 // Hanya data dengan ID user yang bukan 0 yang dihitung
            ]
        );

        // Mengembalikan jumlah donatur terdaftar yang telah berhasil berdonasi.
        return $this->baseModel->fetch()['id_user'];
    }

    /**
     * Mengambil data pemasukkan bulanan.
     *
     * @return array Sebuah array yang berisi data pemasukkan bulanan.
     */
    public function getDataPemasukkanBulanan(): array
    {
        $view = $this->view['pemasukkanBulanan'];
        $this->baseModel->selectData($view);

        // Mengembalikan data pemasukkan bulanan dalam bentuk array.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil data pemasukkan harian.
     *
     * @return array Sebuah array yang berisi data pemasukkan harian.
     */
    public function getDataPemasukkanHarian(): array
    {
        $view = $this->view['pemasukkanHarian'];
        $this->baseModel->selectData($view);

        // Mengembalikan data pemasukkan harian dalam bentuk array.
        return $this->baseModel->fetchAll();
    }

    /**
     * ------------------------------------------------------------------------------------------------------------------------------------------------------
     *              ACTION DATA 
     * ------------------------------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Melakukan konfirmasi pembayaran tunai.
     *
     * @param array $dataPost Data yang dikirim melalui POST request.
     * @param array $dataFile Data file yang dikirim.
     * @return int|string Hasil dari operasi konfirmasi pembayaran.
     */
    public function konfirmasiDataTransaksi($dataPost, $dataFile): int|string
    {
        $nomor_pembayaran   = $dataPost['nomor-pembayaran'];
        $jumlah_pembayaran  = str_replace('.', '', $dataPost['nominal-donasi']);
        $gambar             = Utility::uploadImage($dataFile, 'bukti_pembayaran');

        // Memeriksa apakah gambar berhasil diupload.
        if (!is_string($gambar)) {
            return 'Gagal upload gambar!';
        }

        // Mengambil id pembayaran dari basis data berdasarkan nomor pembayaran.
        $this->baseModel->selectData(null, "id_pembayaran", [], ["nomor_pembayaran =" => $nomor_pembayaran]);
        $id_pembayaran = $this->baseModel->fetch()['id_pembayaran'];

        // Mengambil bagian pertama dari nomor pembayaran yang dipisahkan dengan "_".
        $nomor_pembayaran = explode("_", $nomor_pembayaran)[0];

        // Siapkan data untuk melakukan update pembayaran.
        $dataUpdate = [
            "nomor_pembayaran" => $nomor_pembayaran,
            "jumlah_pembayaran" => $jumlah_pembayaran,
            "bukti_pembayaran" => $gambar,
            "tanggal_pembayaran" => date('Y-m-d H:i:s'),
            "status_pembayaran" => "konfirmasi"
        ];

        // Melakukan update data pembayaran.
        return $this->baseModel->updateData($dataUpdate, ["id_pembayaran" => $id_pembayaran]);
    }

    /**
     * Melakukan konfirmasi pembayaran dan memperbarui informasi terkait.
     *
     * @param string $slug Slug program terkait.
     * @param int $id ID donatur terkait.
     * @param string $username Username amil yang melakukan konfirmasi.
     * @param int $jumlah_dana Jumlah dana yang dikonfirmasi.
     * @param string $nama_bank Nama bank yang terkait.
     * @return int Jumlah baris yang terpengaruh oleh operasi.
     */
    public function konfirmasiPembayaran($slug, $id, $username, $jumlah_dana, $nama_bank): int
    {
        // Data pembayaran untuk diupdate.
        $dataPembayaran = [
            "username_amil" => $username,
            "status_pembayaran" => 'success',
        ];

        // Melakukan update status pembayaran pada basis data.
        $rowCount = $this->baseModel->updateData($dataPembayaran, ["id_donatur" => $id]);

        // Menambahkan jumlah donasi dan total dana pada program terkait.
        $tb_program = 'tb_program';
        $query = "UPDATE $tb_program SET total_dana = total_dana + $jumlah_dana, jumlah_donatur = jumlah_donatur + 1 WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        $this->db->execute();

        // Menambahkan saldo_donasi pada rekening terkait.
        $tb_norek = 'tb_norek';
        $nama_bank = join(' ', explode('-', $nama_bank));
        $query = "UPDATE $tb_norek SET saldo_donasi = saldo_donasi + $jumlah_dana WHERE nama_bank = :nama_bank";
        $this->db->query($query);
        $this->db->bind('nama_bank', $nama_bank);
        $this->db->execute();

        return $rowCount;
    }

    /**
     * Membatalkan pembayaran dan mengubah status pembayaran menjadi gagal.
     *
     * @param int $id ID donatur terkait.
     * @param string $username Username amil yang melakukan pembatalan.
     * @return int Jumlah baris yang terpengaruh oleh operasi.
     */
    public function batalkanPembayaran($id, $username): int
    {
        // Data untuk diupdate (membatalkan pembayaran).
        $data = [
            "username_amil" => $username,
            "status_pembayaran" => 'failed',
        ];

        // Melakukan update status pembayaran pada basis data.
        return $this->baseModel->updateData($data, ["id_donatur" => $id]);
    }

    /**
     * Menghapus pembayaran dan data donatur terkait berdasarkan ID donatur.
     *
     * @param int $id ID donatur terkait.
     * @return int Jumlah baris yang terpengaruh oleh operasi penghapusan.
     */
    public function hapusPembayaran(string $kode): int
    {
        // ambil kode nomor pembayaran
        $nomor_pembayaran = explode('_', $kode)[0];

        // Menghapus data pembayaran berdasarkan nomor pembayran.
        $rowCount = $this->baseModel->deleteData(["nomor_pembayaran" => $nomor_pembayaran]);

        // Menghapus data donatur berdasarkan ID donatur.
        $rowCount += $this->modelDonatur->deleteData(["kode" => $kode]);

        return $rowCount;
    }
}
