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
    $uuid           = Utility::generateUUID();
    $nama_mesjid    = $data['nama_mesjid'];
    $alamat_mesjid  = $data['alamat_mesjid'];
    $rt             = $data['RT'];
    $rw             = $data['RW'];
    $provinsi       = $data['provinsi'];
    $kabupaten      = $data['kabupaten'];
    $kecamatan      = $data['kecamatan'];
    $kelurahan      = $data['kelurahan'];

    // intial query
    $query = "INSERT INTO $this->table VALUES(NULL, :uuid, :nama_mesjid, :alamat_mesjid, :rt, :rw, :provinsi, :kabupaten, :kecamatan, :kelurahan)";

    // execute and binding
    $this->db->query($query);
    $this->db->bind('uuid', $uuid);
    $this->db->bind('nama_mesjid', $nama_mesjid);
    $this->db->bind('alamat_mesjid', $alamat_mesjid);
    $this->db->bind('rt', $rt);
    $this->db->bind('rw', $rw);
    $this->db->bind('provinsi', $provinsi);
    $this->db->bind('kabupaten', $kabupaten);
    $this->db->bind('kecamatan', $kecamatan);
    $this->db->bind('kelurahan', $kelurahan);
    $this->db->execute();

    return $this->db->rowCount();

  }

  // method ubah data mesjid
  public function ubahMesjid($data): int {
    // initial query
    $query = "UPDATE $this->table SET nama_mesjid = :nama_mesjid, alamat_mesjid = :alamat_mesjid, RT = :RT, RW = :RW, provinsi = :provinsi, kabupaten = :kabupaten, kecamatan = :kecamatan, kelurahan = :kelurahan WHERE id_mesjid = :id_mesjid";
    $this->db->query($query);
    $this->db->bind('id_mesjid', $data['id']);
    $this->db->bind('nama_mesjid', $data['nama_mesjid']);
    $this->db->bind('alamat_mesjid', $data['alamat_mesjid']);
    $this->db->bind('RT', $data['RT']);
    $this->db->bind('RW', $data['RW']);
    $this->db->bind('provinsi', $data['provinsi']);
    $this->db->bind('kabupaten', $data['kabupaten']);
    $this->db->bind('kecamatan', $data['kecamatan']);
    $this->db->bind('kelurahan', $data['kelurahan']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  // method hapus data mesjid
  public function hapusMesjid(string $uuid): int {
    // initial query
    $query = "DELETE FROM $this->table WHERE UUID = :uuid";
    $this->db->query($query);
    $this->db->bind('uuid', $uuid);
    $this->db->execute();
    return $this->db->rowCount();
  }

}