<?php

class Masjid_model {

  private $table = 'tb_mesjid';
  private $db;

  // constructor
  public function __construct()
  {
    $this->db = new Database();
  }

  // method get data masjid
  public function getDataMasjid(): array {

    $query = "SELECT * FROM $this->table";
    $this->db->query($query);
    return $this->db->resultSet();

  }

  // method get data masjid by id
  public function getDataMasjidById($id): array {

    $query = "SELECT * FROM $this->table WHERE id_mesjid = :id_mesjid";
    $this->db->query($query);
    $this->db->bind('id_mesjid', $id);
    $result = $this->db->single();
    return $result;

  }

  // methode tambah mesjid
  public function tambahMesjid($data): int {

    // initial
    $nama_mesjid    = $data['nama_mesjid'];
    $alamat_mesjid  = $data['alamat_mesjid'];
    $rt             = $data['RT'];
    $rw             = $data['RW'];

    // intial query
    $query = "INSERT INTO $this->table VALUES(NULL, :nama_mesjid, :alamat_mesjid, :rt, :rw)";

    // execute and binding
    $this->db->query($query);
    $this->db->bind('nama_mesjid', $nama_mesjid);
    $this->db->bind('alamat_mesjid', $alamat_mesjid);
    $this->db->bind('rt', $rt);
    $this->db->bind('rw', $rw);
    $this->db->execute();

    return $this->db->rowCount();

  }

  // method ubah data mesjid
  public function ubahMesjid($data): int {
    // initial query
    $query = "UPDATE $this->table SET nama_mesjid = :nama_mesjid, alamat_mesjid = :alamat_mesjid, RT = :RT, RW = :RW WHERE id_mesjid = :id_mesjid";
    $this->db->query($query);
    $this->db->bind('id_mesjid', $data['id']);
    $this->db->bind('nama_mesjid', $data['nama_mesjid']);
    $this->db->bind('alamat_mesjid', $data['alamat_mesjid']);
    $this->db->bind('RT', $data['RT']);
    $this->db->bind('RW', $data['RW']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  // method hapus data mesjid
  public function hapusMesjid($id): int {
    // initial query
    $query = "DELETE FROM $this->table WHERE id_mesjid = $id";
    $this->db->query($query);
    $this->db->execute();
    return $this->db->rowCount();
  }

}