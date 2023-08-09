<?php

class Masjid_model
{

  private $table = 'tb_mesjid';
  private $baseModel;

  // constructor
  public function __construct()
  {
    $this->baseModel = new BaseModel($this->table);
  }

  // method get data masjid
  public function getDataMasjid(): array
  {
    $this->baseModel->selectData();
    return $this->baseModel->fetchAll();
  }

  // method get data masjid by id
  public function getDataMasjidById($id): array
  {
    $this->baseModel->selectData(null, null, [], ["id_mesjid =" => $id]);
    return $this->baseModel->fetch();
  }

  // methode tambah mesjid
  public function tambahMesjid($data): int|string
  {

    // cek panjang dari RT RW
    $lenRT = strlen($data['RT']);
    $lenRW = strlen($data['RW']);
    if(($lenRT > 3 || $lenRT < 2) && ($lenRW > 3 || $lenRW < 2)) return 'Minimal 2 dan Maksimal 3 karakter dari RT/RW!';
    
    $dataInsert = [
      "uuid" => Utility::generateUUID(),
      "nama_mesjid" => $data['nama_mesjid'], 
      "alamat_mesjid" => $data['alamat_mesjid'],
      "RT" => $data['RT'],
      "RW" => $data['RW'],
      "provinsi" => $data['provinsi'], 
      "kabupaten" => $data['kabupaten'],
      "kecamatan" => $data['kecamatan'],
      "kelurahan" => $data['kelurahan']
    ];

    return $this->baseModel->insertData($dataInsert);
  }

  // method ubah data mesjid
  public function updateData(array $data): int
  {
    $dataUpdate = [
      "nama_mesjid" => $data['nama_mesjid'],
      "alamat_mesjid" => $data['alamat_mesjid'],
      "RT" => $data['RT'],
      "RW" => $data['RW'],
      "provinsi" => $data['provinsi'],
      "kabupaten" => $data['kabupaten'],
      "kecamatan" => $data['kecamatan'],
      "kelurahan" => $data['kelurahan']
    ];
    return $this->baseModel->updateData($dataUpdate, ["id_mesjid" => $data['id']]);
  }

  // method hapus data mesjid
  public function hapusMesjid(string $uuid): int
  {
    return $this->baseModel->deleteData(['UUID' => $uuid]);
  }
}
