<?php

class Program_model
{

    /**
     * Atribut-atribut yang digunakan dalam kelas ProgramModel.
     */
    private $table = 'tb_program'; // Nama tabel basis data yang digunakan.
    private $baseModel; // Objek BaseModel untuk operasi basis data.
    private $view = [
        "allZakat" => "vwAllDataZakat", // Nama tampilan untuk data Zakat.
        "allDataProgramBarang" => "vwAllProgramBarangAktif", // Nama tampilan untuk data program barang aktif.
        "allDataProgramAktif" => "vwAllDataProgramAktif", // Nama tampilan untuk semua data program aktif.
        "allDataProgramAktifTunai" => "vwAllProgramAktifTunai", // Nama tampilan untuk semua data program aktif dengan jenis pembayaran tunai.
        "allDataProgramHaveMoney" => "vwAllProgramHaveMoney", // Nama tampilan untuk semua data program yang memiliki dana terkumpul.
        "sumProgram" => "vwSumProgram", // Nama tampilan untuk data total dana program.
    ];

    /**
     * Konstruktor kelas ProgramModel.
     * Inisialisasi objek BaseModel dengan menggunakan tabel yang ditentukan.
     */
    public function __construct()
    {
        $this->baseModel = new BaseModel($this->table);
    }

    /**
     * ---------------------------------------------------------
     *                      GET DATA
     * ---------------------------------------------------------
     */

    /**
     * Mengambil semua data dari basis data sesuai dengan kondisi yang diberikan.
     *
     * @param array $kondisi Kondisi untuk pengambilan data dalam bentuk array asosiatif.
     * Contoh: ["field =" => "value"] atau ["logic" => "AND", "field = " => "value", "field2 = " => "value2"].
     * @return array Sebuah array yang berisi data yang diambil dari basis data sesuai dengan kondisi yang diberikan.
     */
    public function getAllData(array $kondisi): array
    {
        // Melakukan operasi SELECT data dari basis data dengan kondisi yang diberikan.
        // Menggunakan view 'allDataProgramAktif', mengurutkan berdasarkan datetime descending.
        $this->baseModel->selectData($this->view['allDataProgramAktif'], null, ["datetime" => "DESC"], $kondisi);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Menghitung jumlah total dana dari program tertentu atau seluruh program.
     *
     * @method Sum
     * @param string $jenis_program Jenis program yang akan dihitung total dana. 
     * Jika NULL, menghitung total dari seluruh program.
     * @return string Jumlah total dana dari program dalam format dengan pemisah ribuan.
     */
    public function getSumProgram(string $jenis_program = NULL): string
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['sumProgram'];

        // Memilih data dari view berdasarkan jenis_program (jika disediakan).
        // Jika jenis_program NULL, memilih semua data.
        (is_null($jenis_program)) ? $this->baseModel->selectData($view) : $this->baseModel->selectData($view, null, [], ["jenis_program =" => $jenis_program]);

        // Mengambil data hasil query untuk total_dana dan memformatnya dengan pemisah ribuan.
        return number_format($this->baseModel->fetch()['total_dana'], 0, ',', '.');
    }

    /**
     * Mengambil semua data program yang memiliki dana.
     *
     * @method GetAllData
     * @param NULL
     * @return array Sebuah array yang berisi data program yang memiliki dana.
     */
    public function getAllDataProgramHaveMoney(): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramHaveMoney'];

        // Memilih semua data program yang memiliki dana dari view.
        $this->baseModel->selectData($view);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil semua data program aktif dengan jenis pembayaran tunai.
     *
     * @param string $jenis_program Jenis program yang akan diambil datanya.
     * @return array Sebuah array yang berisi data program aktif dengan jenis pembayaran tunai.
     */
    public function getAllDataProgramTunai(string $jenis_program): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramAktif'];

        // Memilih data program aktif dengan jenis pembayaran tunai dari view.
        $this->baseModel->selectData($view, null, ["id_program" => "DESC"], ["logic" => "AND", "jenis_program =" => ucwords($jenis_program), "jenis_pembayaran <>" => "barang"]);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil semua data program yang aktif.
     *
     * @return array Sebuah array yang berisi data program aktif.
     */
    public function getAllDataProgramAktif(): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramAktif'];

        // Memilih semua data program yang aktif dari view.
        $this->baseModel->selectData($view, null, ["id_program" => "DESC"]);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil semua data program aktif dengan jenis pembayaran tunai.
     *
     * @return array Sebuah array yang berisi data program aktif dengan jenis pembayaran tunai.
     */
    public function getAllDataProgramAktifTunai(): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramAktifTunai'];

        // Memilih semua data program aktif dengan jenis pembayaran tunai dari view.
        $this->baseModel->selectData($view, null, ["id_program" => "DESC"]);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil semua data program dengan jenis pembayaran berupa barang.
     *
     * @param string $program Jenis program yang akan diambil datanya.
     * @return array Sebuah array yang berisi data program dengan jenis pembayaran barang.
     */
    public function getAllDataProgramBarang(string $program = NULL): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramBarang'];

        // Jika $program adalah NULL
        if (is_null($program)) {
            // Memilih semua data program dengan jenis pembayaran barang dari view.
            $this->baseModel->selectData($view);
        } else {
            // Memilih data program dengan jenis pembayaran barang sesuai jenis program yang diberikan.
            $this->baseModel->selectData($view, null, [], ["jenis_program =" => ucwords($program)]);
        }

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil data program aktif dengan jenis program tertentu sebanyak $limit data.
     *
     * @param int $limit Jumlah data yang akan diambil.
     * @param string $jenisprogram Jenis program yang akan diambil datanya.
     * @return array Sebuah array yang berisi data program aktif dengan jenis program tertentu dan batasan jumlah data.
     */
    public function getDataProgramLimitByJenisProgram($limit, $jenisprogram): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramAktif'];

        // Memilih data program aktif dengan jenis program tertentu dari view dengan batasan jumlah data.
        $this->baseModel->selectData($view, null, ["id_program" => "DESC"], ["logic" => "AND", "jenis_program =" => $jenisprogram, "jenis_pembayaran <>" => "barang"], "LIMIT " . $limit);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil data program Zakat sebanyak $limit data.
     *
     * @param int $limit Jumlah data yang akan diambil.
     * @return array Sebuah array yang berisi data program Zakat dengan batasan jumlah data.
     */
    public function getDataProgramZakatLimit($limit): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allZakat'];

        // Memilih data program Zakat dari view dengan batasan jumlah data.
        $this->baseModel->selectData($view, null, ["id_program" => "DESC"], null, "LIMIT " . $limit);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil semua data program yang memiliki dana berdasarkan ID program.
     *
     * @param int $id ID program yang akan digunakan sebagai filter.
     * @return array Sebuah array yang berisi data program yang memiliki dana berdasarkan ID program.
     */
    public function getAllDataProgramHaveMoneyById($id): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramHaveMoney'];

        // Memilih semua data program yang memiliki dana berdasarkan ID program dari view.
        $this->baseModel->selectData($view, null, [], ["id_program =" => $id]);

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mengambil data program aktif berdasarkan slug.
     *
     * @param string $slug Slug program yang akan digunakan sebagai filter.
     * @return array|bool Sebuah array yang berisi data program aktif berdasarkan slug, atau false jika tidak ditemukan.
     */
    public function getDataProgramAktifBySlug(string $slug): array|bool
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramAktif'];

        // Memilih data program aktif berdasarkan slug dari view.
        $this->baseModel->selectData($view, null, [], ["slug =" => $slug]);

        // Mengambil data yang diambil dari basis data menggunakan fetch.
        $data = $this->baseModel->fetch();

        // Mengembalikan data jika ditemukan, atau false jika tidak ditemukan.
        return ($data) ? $data : false;
    }

    /**
     * Mengambil data program aktif (tunai) berdasarkan kata kunci.
     *
     * @param string $keyword Kata kunci yang akan digunakan sebagai filter.
     * @return array Sebuah array yang berisi data program aktif (tunai) berdasarkan kata kunci.
     */
    public function getDataProgramAktifByKeyword(string $keyword): array
    {
        // Mendefinisikan view yang akan digunakan untuk pengambilan data.
        $view = $this->view['allDataProgramAktifTunai'];

        // Memilih data program aktif (tunai) berdasarkan kata kunci dari view.
        $this->baseModel->selectData($view, null, ["id_program" => "DESC"], ["logic" => "OR", "nama_program LIKE" => "%$keyword%", "slug LIKE" => "%$keyword%", "jenis_program LIKE" => "%$keyword%"], "LIMIT 3");

        // Mengambil dan mengembalikan data yang diambil dari basis data.
        return $this->baseModel->fetchAll();
    }

    /**
     * Melakukan operasi CRUD untuk menambah data program.
     *
     * @param string $jenis_program Jenis program yang akan ditambahkan.
     * @param array $dataPost Data yang dikirimkan melalui POST request.
     * @param array|null $dataFiles Data gambar yang dikirimkan melalui FILES request (opsional).
     * @return int|string Jumlah baris yang berhasil diubah atau pesan error jika terjadi masalah.
     */
    public function tambahDataProgram(string $jenis_program, array $dataPost, array $dataFiles = NULL): int|string
    {
        // Inisialisasi variabel dengan nilai awal.
        $namaprogram = ucwords(htmlspecialchars($dataPost['nama-program']));
        $jenis_pembayaran = $dataPost['jenis-pembayaran'];
        $deskripsi = ucwords(htmlspecialchars($dataPost['deskripsi']));
        $gambar = NULL;
        $content = NULL;
        $nominal_bayar = NULL;
        $uuid = Utility::generateUUID();

        // Jika terdapat data content dalam data post, asign ke variabel content.
        if (isset($dataPost['content'])) {
            $content = $dataPost['content'];
        }

        // Jika terdapat data nominal-bayar dalam data post, assign ke variabel nominal_bayar.
        if (isset($dataPost['nominal-bayar'])) {
            $nominal_bayar = str_replace('.', '', $dataPost['nominal-bayar']);
        }

        // Membuat slug dari nama program.
        $slug = strtolower(join('', explode(' ', $namaprogram)));

        // Jika dataFiles bukan NULL, upload gambar dan asign ke variabel gambar.
        if ($dataFiles !== NULL) {
            $gambar = Utility::uploadImage($dataFiles, 'program');
        }

        // Mengecek apakah slug telah digunakan sebelumnya.
        if ($this->baseModel->isData(["slug" => $slug])) {
            return 'Nama Program Telah Tersedia';
        }

        // Mengecek apakah gambar berhasil diupload.
        if ((!is_string($gambar)) && ($gambar !== NULL)) {
            return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';
        }

        // Menyiapkan data untuk operasi insert.
        $dataInsert = [
            "uuid" => $uuid,
            "nama_program" => ucwords($namaprogram),
            "slug" => $slug,
            "jenis_program" => $jenis_program,
            "jenis_pembayaran" => $jenis_pembayaran,
            "deskripsi_program" => ucwords($deskripsi),
            "nominal_bayar" => $nominal_bayar,
            "total_dana" => 0,
            "jumlah_donatur" => 0,
            "gambar" => $gambar,
            "content" => $content,
            "datetime" => date('Y-m-d H:i:s')
        ];

        // Melakukan operasi insert data dan mengembalikan hasilnya.
        return $this->baseModel->insertData($dataInsert);
    }
}
