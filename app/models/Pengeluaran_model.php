<?php

class Pengeluaran_model
{

    /**
     * Nama tabel yang digunakan untuk data pengeluaran.
     *
     * @var string
     */
    private $table = "tb_pengeluaran";

    /**
     * Nama view yang digunakan untuk data pengeluaran tunai dan barang.
     *
     * @var array
     */
    private $view = [
        "allDataPengeluaranTunai"   => "vwAllDataPengeluaranTunai",
        "allDataPengeluaranBarang"  => "vwAllDataPengeluaranBarang"
    ];

    /**
     * Objek model dasar yang mungkin digunakan untuk operasi database terkait data pengeluaran.
     *
     * @var BaseModel
     */
    private $baseModel;

    private $db;

    /**
     * Constructer untuk inisialisasi objek BaseModel dan objek Database.
     * 
     * Ini akan membuat objek BaseModel yang terhubung dengan tabel pengeluaran
     * dan objek Database yang mungkin digunakan untuk operasi database.
     */
    public function __construct()
    {
        // Membuat objek BaseModel yang terhubung dengan tabel pengeluaran
        $this->baseModel = new BaseModel($this->table);

        // Membuat objek Database yang mungkin digunakan untuk operasi database.
        $this->db = new Database();
    }

    /**
     * Mendapatkan semua data pengeluaran tunai dari sumber data.
     *
     * @return array Array berisi data pengeluaran tunai.
     */
    public function getAllDataPengeluaranTunai(): array
    {
        // Menggunakan nama view 'allDataPengeluaranTunai' yang mungkin telah ditentukan sebelumnya.
        $view = $this->view['allDataPengeluaranTunai'];

        // Menggunakan baseModel untuk melakukan pemilihan data dari view yang telah ditentukan.
        $this->baseModel->selectData($view);

        // Mengembalikan semua hasil data pengeluaran tunai dalam bentuk array.
        return $this->baseModel->fetchAll();
    }

    /**
     * Mendapatkan semua data pengeluaran barang dari sumber data.
     *
     * @return array Array berisi data pengeluaran barang.
     */
    public function getAllDataPengeluaranBarang(): array
    {
        // Menggunakan nama view 'allDataPengeluaranBarang' yang mungkin telah ditentukan sebelumnya.
        $view = $this->view['allDataPengeluaranBarang'];

        // Menggunakan baseModel untuk melakukan pemilihan data dari view yang telah ditentukan.
        $this->baseModel->selectData($view);

        // Mengembalikan semua hasil data pengeluaran barang dalam bentuk array.
        return $this->baseModel->fetchAll();
    }

    /**
     * 
     * @method GetData WHERE
     * 
     */
    /**
     * Mengambil data pengeluaran tunai berdasarkan ID.
     *
     * @param int $id ID dari data pengeluaran tunai yang ingin diambil.
     * @return array|bool Array berisi data pengeluaran tunai jika ditemukan, atau false jika tidak ditemukan.
     */
    public function getDataPengeluaranTunaiById($id): array|bool
    {
        // Menggunakan nama view 'allDataPengeluaranTunai' yang mungkin telah ditentukan sebelumnya.
        $view = $this->view['allDataPengeluaranTunai'];

        // Menggunakan baseModel untuk memilih data dari view yang telah ditentukan, dengan kondisi ID sesuai dengan parameter.
        $this->baseModel->selectData($view, null, [], ["id_pengeluaran =" => $id]);

        // Mengembalikan satu hasil data pengeluaran tunai dalam bentuk array, atau false jika data tidak ditemukan.
        return $this->baseModel->fetch();
    }

    /**
     * Mengambil data pengeluaran barang berdasarkan ID.
     *
     * @param int $id ID dari data pengeluaran barang yang ingin diambil.
     * @return array|bool Array berisi data pengeluaran barang jika ditemukan, atau false jika tidak ditemukan.
     */
    public function getDataPengeluaranBarangById($id): array|bool
    {
        // Menggunakan nama view 'allDataPengeluaranBarang' yang mungkin telah ditentukan sebelumnya.
        $view = $this->view['allDataPengeluaranBarang'];

        // Menggunakan baseModel untuk memilih data dari view yang telah ditentukan, dengan kondisi ID sesuai dengan parameter.
        $this->baseModel->selectData($view, null, [], ["id_pengeluaran =" => $id]);

        // Mengembalikan satu hasil data pengeluaran barang dalam bentuk array, atau false jika data tidak ditemukan.
        return $this->baseModel->fetch();
    }


    /** 
     *
     * @method CRUD
     * 
     */
    /**
     * Menambahkan data pengeluaran tunai ke dalam sumber data.
     *
     * @param array $data Array berisi data-data yang akan dimasukkan.
     * @return int Hasil dari operasi penambahan data pengeluaran tunai (biasanya ID dari data yang baru ditambahkan).
     */
    public function tambahDataPengeluaranTunai(array $data): int
    {
        // Menghilangkan tanda titik pada nominal (asumsi format input nominal menggunakan titik sebagai pemisah ribuan).
        $nominal = str_replace('.', '', $data['nominal']);

        // Inisialisasi dataArray dengan nilai-nilai yang diberikan
        $dataArray = array(
            'id_program'        => $data['id-program'],
            'id_bank'           => $data['id-bank'],
            'username_amil'     => $data['username_amil'],
            'nama_penerima'     => ucwords(htmlspecialchars($data['nama-penerima'])),
            'alamat'            => $data['alamat'],
            'nohp'              => $data['nohp'],
            'jenis_pengeluaran' => 'uang',
            'nominal'           => str_replace('.', '', $data['nominal']),
            'keterangan'        => htmlspecialchars($data['keterangan']),
            'tanggal'           => date('Y-m-d H:i:s')
        );

        // Mengurangkan jumlah donasi program berdasarkan nominal yang dikeluarkan.
        $tb_program = 'tb_program';
        $updateProgram = "UPDATE $tb_program SET total_dana = total_dana - $nominal WHERE id_program = :id_program";
        $this->db->query($updateProgram);
        $this->db->bind('id_program', $dataArray['id_program']);
        $this->db->execute();

        // Mengurangkan jumlah saldo donasi pada rekening berdasarkan nominal yang dikeluarkan.
        $tb_norek = 'tb_norek';
        $updateNorek = "UPDATE $tb_norek SET saldo_donasi = saldo_donasi - $nominal WHERE id_norek = :id_norek";
        $this->db->query($updateNorek);
        $this->db->bind('id_norek', $dataArray['id_norek']);
        $this->db->execute();

        // Menyisipkan data pengeluaran ke dalam sumber data.
        return $this->baseModel->insertData($dataArray);
    }

    /**
     * Menambahkan data pengeluaran barang ke dalam sumber data.
     *
     * @param array $data Array berisi data-data yang akan dimasukkan.
     * @return int Hasil dari operasi penambahan data pengeluaran barang (biasanya ID dari data yang baru ditambahkan).
     */
    public function tambahDataPengeluaranBarang($data)
    {
        // Menghilangkan tanda titik pada nominal (asumsi format input nominal menggunakan titik sebagai pemisah ribuan).
        $nominal = str_replace('.', '', $data['nominal']);

        // Menginisialisasi dataArray dengan nilai-nilai yang diberikan
        $dataArray = array(
            'id_program'        => $data['id-program'],
            'id_bank'           => NULL,  // Nilai id_bank diisi NULL
            'username_amil'     => $data['username_amil'],
            'nama_penerima'     => ucwords(htmlspecialchars($data['nama-penerima'])),
            'alamat'            => $data['alamat'],
            'nohp'              => $data['nohp'],
            'jenis_pengeluaran' => 'barang',
            'nominal'           => $nominal,  // Menggunakan nilai nominal yang telah dihilangkan tanda titik.
            'keterangan'        => htmlspecialchars($data['keterangan']),
            'tanggal'           => date('Y-m-d H:i:s')
        );

        // Mengurangkan jumlah donasi program berdasarkan nominal yang dikeluarkan.
        $tb_program = 'tb_program';
        $updateProgram = "UPDATE $tb_program SET total_dana = total_dana - $nominal WHERE id_program = :id_program";
        $this->db->query($updateProgram);
        $this->db->bind('id_program', $dataArray['id_program']);
        $this->db->execute();

        // Menyisipkan data pengeluaran ke dalam sumber data.
        return $this->baseModel->insertData($dataArray);
    }
}
