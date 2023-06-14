<?php

class Kelolaprogram_model {

    private $table = 'tb_program';
    private $view = [
        "allZakat" => "vwAllDataZakat",
        "allInfaq" => "vwAllDataInfaq",
        "allProgramNameAktif" => "vwAllProgramNameAktif",
        "allDataProgramAktif" => "vwAllDataProgramAktif"
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /* =================
    
        @Get All Data
    
    ====================*/

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
        return [];
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

    /**
     * 
     * @param Limit
     * 
     */
    public function getDataProgramLimitByJenisProgram($limit, $jenisprogram): array
    {
        $query = "SELECT * FROM $this->table WHERE jenis_program = :jenis_program ORDER BY id_program DESC LIMIT $limit";
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
     * @param Get Data By
     * 
    */
    public function getDataProgramBySlug($slug): array
    {
        $query = "SELECT * FROM $this->table WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }


     /* =================
    
        @Aksi CRUD Data
    
    ====================*/

    /**
     * 
     * @param Infaq
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


}