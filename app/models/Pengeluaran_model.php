<?php

class Pengeluaran_model {

    private $table = "tb_pengeluaran";
    private $view = [
        "allDataPengeluaran"        => "vwAllDataPengeluaran",
        "allDataPengeluaranTunai"   => "vwAllDataPengeluaranTunai"
    ];
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllDataPengeluaran(): array
    {
        return [];
    }

    public function getAllDataPengeluaranTunai(): array
    {
        $view = $this->view['allDataPengeluaranTunai'];
        $query = "SELECT * FROM $view";
        $this->db->query($query);
        return $this->db->resultSet();
    }


    /** 
     *
     * @method CRUD
     * 
    */
    public function tambahDataPengeluaranTunai($data)
    {
        // initial variabel
        $nama_penerima      = htmlspecialchars($data['nama-penerima']);
        $id_program         = $data['id-program'];
        $id_bank            = $data['id-bank'];
        $nominal            = $data['nominal'];
        $alamat             = $data['alamat'];
        $nohp               = $data['nohp'];
        $jenis_pengeluaran  = 'uang';
        $keterangan         = htmlspecialchars($data['keterangan']);

        // pengurangan jumlah donasi program
        $tb_program = 'tb_program';
        $updateProgram = "UPDATE $tb_program SET total_dana = total_dana - $nominal WHERE id_program = :id_program";
        $this->db->query($updateProgram);
        $this->db->bind('id_program', $id_program);
        $this->db->execute();

        // pengurangan jumlha saldo donasi pada rekening
        $tb_norek = 'tb_norek';
        $updateNorek = "UPDATE $tb_norek SET saldo_donasi = saldo_donasi - $nominal WHERE id_norek = :id_norek";
        $this->db->query($updateNorek);
        $this->db->bind('id_norek', $id_bank);
        $this->db->execute();
        
        // insert data pengeluaran
        $query = "INSERT INTO $this->table VALUES(NULL, :id_program, :id_bank, :nama_penerima, :alamat, :nohp, :jenis_pengeluaran, :nominal, :keterangan, NOW())";
        $this->db->query($query);
        $this->db->bind('id_program', $id_program);
        $this->db->bind('id_bank', $id_bank);
        $this->db->bind('nama_penerima', $nama_penerima);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('nohp', $nohp);
        $this->db->bind('jenis_pengeluaran', $jenis_pengeluaran);
        $this->db->bind('nominal', $nominal);
        $this->db->bind('keterangan', $keterangan);
        $this->db->execute();

        return $this->db->rowCount();
    }

}