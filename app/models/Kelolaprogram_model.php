<?php

class Kelolaprogram_model {

    private $db;
    private $table = 'tb_program';
    private $tb_kategori = 'tb_kategoriprogram';
    private $view = [
        "allZakat" => "vwAllDataZakat",
        "allInfaq" => "vwAllDataInfaq",
        "allQurban" => "vwAllDataQurban",
        "allDonasi" => "vwAllDataDonasi",
        "allRamadhan" => "vwAllDataRamadhan",
        "allDataProgramBarang" => "vwAllProgramBarangAktif",
        "allDataProgramAktif" => "vwAllDataProgramAktif",
        "allDataProgramAktifTunai" => "vwAllProgramAktifTunai",
        "allDataProgramHaveMoney"   => "vwAllProgramHaveMoney",
        "sumProgram"    => "vwSumProgram",
        "sumZakat" => "vwSumProgramZakat",
        "sumInfaq" => "vwSumProgramInfaq",
        "sumQurban" => "vwSumProgramQurban",
    ];

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * 
     * @method Sum (Menjumlahkan Total dana dari program)
     * 
     * @param NULL
     * 
     */
    public function getSumProgram(string $jenis_program = NULL): string 
    {
        $view = $this->view['sumProgram'];

        $q1 = "SELECT * FROM $view WHERE jenis_program = :jenis_program";
        $q2 = "SELECT * FROM $view";
        
        $query = (is_null($jenis_program)) ? $q2 : $q1;
        $this->db->query($query);

        if(!is_null($jenis_program)) $this->db->bind('jenis_program', ucwords($jenis_program));

        return number_format($this->db->single()['total_dana'], 0, ',', '.');
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

    public function getAllDataProgramTunai(string $jenis_program): array
    {
        $view = $this->view['allDataProgramAktif'];
        $query = "SELECT * FROM $view WHERE jenis_program = :jenis_program AND jenis_pembayaran <> 'barang' ORDER BY id_program DESC";
        $this->db->query($query);
        $this->db->bind('jenis_program', ucwords($jenis_program));
        return $this->db->resultSet();
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

    public function getAllKategoriProgram(string $status = null): array 
    {
        $query = "SELECT * FROM $this->tb_kategori";
        // WHERE query jika status tidak null
        if(!is_null($status)) $query .= " WHERE status = :status";
        $this->db->query($query);
        // binding jika status tidak null
        if(!is_null($status)) $this->db->bind('status', $status);
        return $this->db->resultSet();
    }

    public function getAllDataProgramBarang(string $program = NULL): array
    {
        $view = $this->view['allDataProgramBarang'];
        
        // if $program is NULL
        if(is_null($program)) $query = "SELECT * FROM $view";
        else $query = "SELECT * FROM $view WHERE jenis_program = :program";

        // query
        $this->db->query($query);

        // binding if not null
        if(!is_null($program)) $this->db->bind('program', ucwords($program));

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

    public function getAllDataProgramHaveMoneyById($id): array
    {
        $view = $this->view['allDataProgramHaveMoney'];
        $query = "SELECT * FROM $view WHERE id_program = :id_program";
        $this->db->query($query);
        $this->db->bind('id_program', $id);
        return $this->db->resultSet();
    }

    public function getDataProgramAktifBySlug(string $slug): array|bool
    {
        $view = $this->view['allDataProgramAktif'];
        $query = "SELECT * FROM $view WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }

    public function getDataProgramAktifByKeyword(string $keyword): array
    {
        $view = $this->view['allDataProgramAktifTunai'];
        $query = "SELECT * FROM $view WHERE nama_program LIKE :keyword OR slug LIKE :keyword OR jenis_program LIKE :keyword ORDER BY id_program DESC LIMIT 3";
        $this->db->query($query);
        $this->db->bind('keyword', '%'.$keyword.'%');
        return $this->db->resultSet();
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

    public function ubahStatusProgram(int $id, string $status): int {
        $query = "UPDATE $this->tb_kategori SET status = :status WHERE id_kategoriprogram = :id";
        $this->db->query($query);
        $this->db->bind('status', $status);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

}