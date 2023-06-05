<?php

class Kelolaprogram_model {

    private $table = 'tb_program';
    private $view = [
        "allZakat" => "vwAllDataZakat"
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
        return [];
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
        return [];
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


    /**
     * 
     * @Get Data By Slug
     * 
    */
    public function getDataZakatBySlug($slug): array
    {
        $query = "SELECT * FROM $this->table WHERE slug = :slug";
        $this->db->query($query);
        $this->db->bind('slug', $slug);
        return $this->db->single();
    }


     /* =================
    
        @Aksi CRUD Data
    
    ====================*/
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
                                                :status, 
                                                NOW())";

        $this->db->query($query);
        $this->db->bind('nama_program', ucwords($namazakat));
        $this->db->bind('slug', $slug);
        $this->db->bind('jenis_program', 'zakat');
        $this->db->bind('jenis_pembayaran', $jenis_pembayaran);
        $this->db->bind('deskripsi_program', $deskripsi);
        $this->db->bind('total_dana', 0);
        $this->db->bind('jumlah_donatur', 0);
        $this->db->bind('gambar', $gambar);
        $this->db->bind('content', $content);
        $this->db->bind('status', '1');
        $this->db->execute();

        return $this->db->rowCount();

    }

}