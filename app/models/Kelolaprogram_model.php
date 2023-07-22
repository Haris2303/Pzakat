<?php

class Kelolaprogram_model {

    private $table = 'tb_program';
    private $view = [
        "allZakat" => "vwAllDataZakat",
        "allInfaq" => "vwAllDataInfaq",
        "allQurban" => "vwAllDataQurban",
        "allDataProgramBarang" => "vwAllProgramBarangAktif",
        "allProgramNameAktif" => "vwAllProgramNameAktif",
        "allDataProgramAktif" => "vwAllDataProgramAktif",
        "allDataProgramAktifTunai" => "vwAllProgramAktifTunai",
        "allDataProgramHaveMoney"   => "vwAllProgramHaveMoney",
        "sumZakat" => "vwSumProgramZakat",
        "sumInfaq" => "vwSumProgramInfaq",
        "sumQurban" => "vwSumProgramQurban",
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * 
     * @method Sum
     * 
     * @param NULL
     * 
     */
    public function getSumProgramZakat() {
        $view = $this->view['sumZakat'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->single();
    }

    public function getSumProgramInfaq() {
        $view = $this->view['sumInfaq'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->single();
    }

    public function getSumProgramQurban() {
        $view = $this->view['sumQurban'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->single();
    }


    /**
     * 
     * @method GetAllData
     * 
     * @param NULL
     * 
     */

    public function getAllDataProgramHaveMoney(): array
    {
        $view = $this->view['allDataProgramHaveMoney'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgram(): array
    {
        return [];
    }

    public function getAllDataProgramAktif(): array
    {
        $view = $this->view['allDataProgramAktif'];
        $query = "SELECT * FROM $view ORDER BY id_program DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgramAktifTunai(): array
    {
        $view = $this->view['allDataProgramAktifTunai'];
        $query = "SELECT * FROM $view ORDER BY id_program DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgramZakat(): array
    {
        $view = $this->view['allZakat'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgramInfaq(): array
    {
        $view = $this->view['allInfaq'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgramDonasi(): array
    {
        return [];
    }

    public function getAllDataProgramQurban(): array
    {
        $view = $this->view['allQurban'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgramRamadhan(): array
    {
        return [];
    }

    public function getAllProgramNameAktif(): array 
    {
        $view = $this->view['allProgramNameAktif'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getAllDataProgramBarang(): array
    {
        $view = $this->view['allDataProgramBarang'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * 
     * @method GetAllData WHERE jenis_pembayaran
     * 
     */
    public function getAllDataProgramZakatTunai(): array
    {
        $view = $this->view['allZakat'];
        $query = "SELECT * FROM $view WHERE jenis_pembayaran <> 'barang'";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * 
     * @method Limit
     * 
     * @param Limit|JenisProgram
     * 
     */
    public function getDataProgramLimitByJenisProgram($limit, $jenisprogram): array
    {
        $view = $this->view['allDataProgramAktif'];
        $query = "SELECT * FROM $view WHERE jenis_program = :jenis_program AND jenis_pembayaran <> 'barang' ORDER BY id_program DESC LIMIT $limit";
        $this->db->query($query);
        $this->db->bind('jenis_program', $jenisprogram);
        return $this->db->resultSet();
    }

    public function getDataProgramZakatLimit($limit): array 
    {
        $view = $this->view['allZakat'];
        $query = "SELECT * FROM $view ORDER BY id_program DESC LIMIT $limit";
        $this->db->query($query);
        return $this->db->resultSet();
    }


    /**
     * 
     * @method Get Data By
     * @param Slug
     * 
    */
    public function getAllDataProgramAktifByJenisProgram($jenis_program)
    {
        $view = $this->view['allDataProgramAktifTunai'];
        $query = "SELECT * FROM $view WHERE jenis_program = :jenis_program";
        $this->db->query($query);
        $this->db->bind('jenis_program', $jenis_program);
        return $this->db->resultSet();
    }

    public function getAllDataProgramHaveMoneyById($id): array
    {
        $view = $this->view['allDataProgramHaveMoney'];
        $query = "SELECT * FROM $view WHERE id_program = :id_program";
        $this->db->query($query);
        $this->db->bind('id_program', $id);
        return $this->db->resultSet();
    }

    public function getDataProgramBySlug($slug): array|bool
    {
        $query = "SELECT * FROM $this->table WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }

    /**
     * 
     * @method CRUD
     * 
     * @param POST|FILES
     * 
     */
    public function tambahDataZakat($dataPost, $dataFiles) {

        // initial variabel
        $namazakat          = $dataPost['nama-zakat'];
        $jenis_pembayaran   = $dataPost['jenis-pembayaran'];
        $deskripsi          = $dataPost['deskripsi'];
        $content            = $dataPost['content'];
        $gambar             = Utility::uploadImage($dataFiles, 'program');

        // buat slug
        $slug = strtolower(join('', explode(' ', $namazakat)));

        // cek slug
        $cek = "SELECT slug FROM $this->table WHERE slug = :slug";
        $this->db->query($cek);
        $this->db->bind('slug', $slug);
        if(count($this->db->resultSet()) > 0) return 'Nama Zakat Telah Tersedia';

        // cek gambar
        if(!is_string($gambar)) return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, 
                                                :nama_program, 
                                                :slug, 
                                                :jenis_program, 
                                                :jenis_pembayaran, 
                                                :deskripsi_program, 
                                                NULL,
                                                :total_dana, 
                                                :jumlah_donatur, 
                                                :gambar, 
                                                :content,
                                                NOW())";

        $this->db->query($query);
        $this->db->bind('nama_program', ucwords($namazakat));
        $this->db->bind('slug', $slug);
        $this->db->bind('jenis_program', 'Zakat');
        $this->db->bind('jenis_pembayaran', $jenis_pembayaran);
        $this->db->bind('deskripsi_program', ucwords($deskripsi));
        $this->db->bind('total_dana', 0);
        $this->db->bind('jumlah_donatur', 0);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('content', $content);
        $this->db->execute();

        return $this->db->rowCount();

    }

    public function tambahDataZakatBarang($dataPost) {
        // initial variabel
        $nama_zakat         = $dataPost['nama-zakat'];
        $deskripsi          = $dataPost['deskripsi'];
        $jenis_program      = 'Zakat';
        $jenis_pembayaran   = 'barang';
        $berat_barang       = 0;
        $jumlah_donatur     = 0;
        $gambar             = NULL;
        $content            = NULL;
        
        // buat slug
        $slug = strtolower(join('', explode(' ', $nama_zakat)));

        // cek slug
        $cek = "SELECT slug FROM $this->table WHERE slug = :slug";
        $this->db->query($cek);
        $this->db->bind('slug', $slug);
        if(count($this->db->resultSet()) > 0) return 'Nama Zakat Telah Tersedia';

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, 
                                                :nama_zakat, 
                                                :slug, 
                                                :jenis_program, 
                                                :jenis_pembayaran, 
                                                :deskripsi_program, 
                                                NULL,
                                                :berat_barang, 
                                                :jumlah_donatur, 
                                                :gambar, 
                                                :content, 
                                                NOW())";
        $this->db->query($query);
        $this->db->bind('nama_zakat', $nama_zakat);
        $this->db->bind('slug', $slug);
        $this->db->bind('jenis_program', $jenis_program);
        $this->db->bind('jenis_pembayaran', $jenis_pembayaran);
        $this->db->bind('deskripsi_program', $deskripsi);
        $this->db->bind('berat_barang', $berat_barang);
        $this->db->bind('jumlah_donatur', $jumlah_donatur);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('content', $content);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function tambahDataInfaq($dataPost, $dataFiles) {

        // initial variabel
        $namainfaq          = $dataPost['nama-infaq'];
        $jenis_pembayaran   = $dataPost['jenis-pembayaran'];
        $deskripsi          = $dataPost['deskripsi'];
        $content            = $dataPost['content'];
        $gambar             = Utility::uploadImage($dataFiles, 'program');

        // buat slug
        $slug = strtolower(join('', explode(' ', $namainfaq)));

        // cek slug
        $cek = "SELECT slug FROM $this->table WHERE slug = :slug";
        $this->db->query($cek);
        $this->db->bind('slug', $slug);
        if(count($this->db->resultSet()) > 0) return 'Nama Infaq Telah Tersedia';

        // cek gambar
        if(!is_string($gambar)) return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, 
                                                :nama_program, 
                                                :slug, 
                                                :jenis_program, 
                                                :jenis_pembayaran, 
                                                :deskripsi_program, 
                                                NULL,
                                                :total_dana, 
                                                :jumlah_donatur, 
                                                :gambar, 
                                                :content,
                                                NOW())";

        $this->db->query($query);
        $this->db->bind('nama_program', ucwords($namainfaq));
        $this->db->bind('slug', $slug);
        $this->db->bind('jenis_program', 'Infaq');
        $this->db->bind('jenis_pembayaran', $jenis_pembayaran);
        $this->db->bind('deskripsi_program', ucwords($deskripsi));
        $this->db->bind('total_dana', 0);
        $this->db->bind('jumlah_donatur', 0);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('content', $content);
        $this->db->execute();

        return $this->db->rowCount();

    }

    public function tambahDataQurban($dataPost, $dataFiles) {

        // initial variabel
        $namaqurban         = $dataPost['nama-qurban'];
        $jenis_pembayaran   = $dataPost['jenis-pembayaran'];
        $deskripsi          = $dataPost['deskripsi'];
        $nominal_bayar      = str_replace('.', '', $dataPost['nominal-bayar']);
        $content            = $dataPost['content'];
        $gambar             = Utility::uploadImage($dataFiles, 'program');

        // buat slug
        $slug = strtolower(join('', explode(' ', $namaqurban)));

        // cek slug
        $cek = "SELECT slug FROM $this->table WHERE slug = :slug";
        $this->db->query($cek);
        $this->db->bind('slug', $slug);
        if(count($this->db->resultSet()) > 0) return 'Nama Qurban Telah Tersedia!';

        // cek gambar
        if(!is_string($gambar)) return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';

        // insert data
        $query = "INSERT INTO $this->table VALUES(NULL, 
                                                :nama_program, 
                                                :slug, 
                                                :jenis_program, 
                                                :jenis_pembayaran, 
                                                :deskripsi_program, 
                                                :nominal_bayar,
                                                :total_dana, 
                                                :jumlah_donatur, 
                                                :gambar, 
                                                :content,
                                                NOW())";

        $this->db->query($query);
        $this->db->bind('nama_program', ucwords($namaqurban));
        $this->db->bind('slug', $slug);
        $this->db->bind('jenis_program', 'qurban');
        $this->db->bind('jenis_pembayaran', $jenis_pembayaran);
        $this->db->bind('deskripsi_program', ucwords($deskripsi));
        $this->db->bind('nominal_bayar', $nominal_bayar);
        $this->db->bind('total_dana', 0);
        $this->db->bind('jumlah_donatur', 0);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('content', $content);
        $this->db->execute();

        return $this->db->rowCount();

    }


}