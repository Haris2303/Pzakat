<?php

class Norek extends Controller
{

    protected $urlNorek = '/norek';

    /**
     * Konstruktor kontroler Norek untuk mengatur akses hanya bagi admin (level 1)
     * 
     * @method __construct
     */
    public function __construct()
    {
        // Jika yang mengakses bukan admin (level bukan 1), alihkan ke halaman utama
        if ($_SESSION['level'] !== '1') {
            header($this->location . '/');
            exit;
        }
    }

    /**
     * Halaman index untuk menampilkan data nomor rekening
     * 
     * @method index
     */
    public function index(): void
    {
        // Mengatur data yang akan dikirimkan ke tampilan (view) halaman index
        $data = [
            "judul" => "Nomor Rekening",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataNorek" => $this->model('Norek_model')->getAllDataNorek(),
            "programNameAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif'),
            "dataBank"  => $this->model('Norek_model')->getDataBankJsonDecode()
        ];
        $data['script'] += ["util" => "/js/util/script.js"];

        // Menampilkan tampilan (view) halaman index dengan menggunakan data yang telah diatur
        $this->view('dashboard/sidebar', $data);
        $this->view('norek/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Halaman detail untuk mengedit nomor rekening berdasarkan ID
     * 
     * @method detail
     * @param string $id - ID nomor rekening yang akan diubah
     */
    public function detail($id): void
    {
        // Mengatur data yang akan dikirimkan ke tampilan (view) halaman detail
        $data = [
            "judul" => "Edit Nomor Rekening",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataNorek" => $this->model('Norek_model')->getDataNorekById($id),
        ];

        // Menampilkan tampilan (view) halaman detail dengan menggunakan data yang telah diatur
        $this->view('dashboard/sidebar', $data);
        $this->view('norek/detail', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Mengambil data nomor rekening berdasarkan ID dalam bentuk JSON
     * 
     * @method ubah
     */
    public function ubah(): void
    {
        echo json_encode($this->model('Norek_model')->getDataNorekById($_POST['id']));
    }

    /**
     * Mengambil data nomor rekening berdasarkan jenis program dalam bentuk JSON
     * 
     * @method getRekeningByJenisProgram
     */
    public function getRekeningByJenisProgram(): void
    {
        echo json_encode($this->model('Norek_model')->getAllDataNorekByProgram($_POST['jenisProgram']));
    }

    /**
     * Aksi tambah data nomor rekening
     * 
     * @method aksi_tambah_norek
     */
    public function aksi_tambah_norek(): void
    {
        $result = $this->model('Norek_model')->tambahDataNorek($_POST, $_FILES);
        // Penanganan hasil tambah data nomor rekening
        if ($result > 0 && is_int($result)) {
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> ditambahkan!', 'success');
        } else {
            Flasher::setFlash($result, 'danger');
        }
        header($this->location . $this->urlNorek);
        exit;
    }

    /**
     * Aksi ubah data nomor rekening
     * 
     * @method aksi_ubah_norek
     */
    public function aksi_ubah_norek(): void
    {
        $result = $this->model('Norek_model')->ubahDataNorek($_POST, $_FILES);
        // Penanganan hasil ubah data nomor rekening
        if ($result > 0 && is_int($result)) {
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> diubah!', 'success');
        } else {
            Flasher::setFlash($result, 'danger');
        }
        header($this->location . $this->urlNorek);
        exit;
    }

    /**
     * Aksi hapus data nomor rekening berdasarkan UUID
     * 
     * @method aksi_hapus_data
     * @param string $uuid - UUID nomor rekening yang akan dihapus
     */
    public function aksi_hapus_data(string $uuid): void
    {
        $result = $this->model('Norek_model')->deleteData($uuid);
        // Penanganan hasil hapus data nomor rekening
        if ($result > 0) {
            Flasher::setFlash('Data Nomor Rekening <strong>Berhasil</strong> dihapus!', 'success');
        } else {
            Flasher::setFlash('Data Nomor Rekening <strong>Gagal</strong> dihapus!', 'danger');
        }
        header($this->location . $this->urlNorek);
        exit;
    }
}
