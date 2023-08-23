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

  /**
   * -----------------------------------------------------------
   *            GET ALL DATA
   * -----------------------------------------------------------
   */

  /**
   * Mendapatkan semua data masjid.
   *
   * @return array Data masjid dalam bentuk array.
   */
  public function getDataMasjid(): array
  {
    $this->baseModel->selectData();
    return $this->baseModel->fetchAll();
  }

  /**
   * ------------------------------------------------------------
   *            GET DATA BY
   * ------------------------------------------------------------
   */

  /**
   * Mendapatkan data masjid berdasarkan ID.
   *
   * @param int $id ID masjid yang akan dicari.
   * @return array Data masjid yang sesuai dengan ID.
   */
  public function getDataMasjidById($id): array
  {
    $this->baseModel->selectData(null, null, [], ["id_mesjid =" => $id]);
    return $this->baseModel->fetch();
  }

  /**
   * -----------------------------------------------------------
   *            ACTION DATA
   * -----------------------------------------------------------
   */

  /**
   * Menambahkan data masjid baru.
   *
   * @param array $data Data masjid yang akan ditambahkan.
   * @return int|string Jumlah baris yang berhasil ditambahkan atau pesan kesalahan.
   */
  public function tambahMesjid($data): int|string
  {

    // cek panjang dari RT RW
    $lenRT = strlen($data['RT']);
    $lenRW = strlen($data['RW']);

    if (($lenRT > 3 || $lenRT < 2) && ($lenRW > 3 || $lenRW < 2)) {
      return 'Minimal 2 dan Maksimal 3 karakter dari RT/RW!';
    }

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

  /**
   * Mengupdate data masjid berdasarkan ID.
   *
   * @param array $data Data masjid yang akan diupdate.
   * @return int Jumlah baris yang berhasil diupdate.
   */
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

  /**
   * Menghapus data masjid berdasarkan UUID.
   *
   * @param string $uuid UUID dari data masjid yang akan dihapus.
   * @return int Jumlah baris yang berhasil dihapus.
   */
  public function hapusMesjid(string $uuid): int
  {
    return $this->baseModel->deleteData(['UUID' => $uuid]);
  }
}
