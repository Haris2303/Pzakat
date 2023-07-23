<?php

class Kelolaprogram_model {

    private $table = 'tb_program';
    private $view = [
        "allZakat" => "vwAllDataZakat",
        "allInfaq" => "vwAllDataInfaq",
        "allQurban" => "vwAllDataQurban",
        "allDonasi" => "vwAllDataDonasi",
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
    public function getSumProgramZakat(): array {
        $view = $this->view['sumZakat'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->single();
    }

    public function getSumProgramInfaq(): array {
        $view = $this->view['sumInfaq'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->single();
    }

    public function getSumProgramQurban(): array {
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
        $view = $this->view['allDonasi'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
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

    public function getAllDataProgramBarang(string $program): array
    {
        $view = $this->view['allDataProgramBarang'];
        $query = "SELECT * FROM $view WHERE jenis_program = :program";
        $this->db->query($query);
        $this->db->bind('program', $program);
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
    public function getAllDataProgramAktifByJenisProgram($jenis_program): array
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

    public function tambahDataProgram(string $jenis_program, array $dataPost, array $dataFiles = NULL): int|string {
        // initial variabel
        $namaprogram        = ucwords(htmlspecialchars($dataPost['nama-program']));
        $jenis_pembayaran   = $dataPost['jenis-pembayaran'];
        $deskripsi          = ucwords(htmlspecialchars($dataPost['deskripsi']));
        $gambar             = NULL;
        $content            = NULL;
        $nominal_bayar      = NULL;

        // if exist data post content
        if(isset($dataPost['content'])) {
            $content = $dataPost['content'];
        }
        
        // if exist data post nominal_bayar
        if(isset($dataPost['nominal-bayar'])) {
            $nominal_bayar = str_replace('.', '', $dataPost['nominal-bayar']);
        }

        // create slug
        $slug = strtolower(join('', explode(' ', $namaprogram)));

        // if datafiles is null
        if($dataFiles !== NULL) {
            $gambar = Utility::uploadImage($dataFiles, 'program');
        }

        // check slug
        $cek = "SELECT slug FROM $this->table WHERE slug = :slug";
        $this->db->query($cek);
        $this->db->bind('slug', $slug);
        if(count($this->db->resultSet()) > 0) return 'Nama Zakat Telah Tersedia';

        // check image
        if((!is_string($gambar)) && ($gambar !== NULL)) return 'Gagal Upload Gambar! Mohon untuk memeriksa <strong>format gambar</strong> dan ukuran gambar kurang dari <strong>2mb</strong>';

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
        $this->db->bind('nama_program', ucwords($namaprogram));
        $this->db->bind('slug', $slug);
        $this->db->bind('jenis_program', $jenis_program);
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