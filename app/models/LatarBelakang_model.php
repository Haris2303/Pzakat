<?php

class LatarBelakang_model
{

  private $table = 'tb_latarbelakang';
  private $baseModel;

  public function __construct()
  {
    $this->baseModel = new BaseModel($this->table);
  }

  /**
   * Mendapatkan data latar belakang pengguna dari database.
   *
   * @return array Data latar belakang pengguna yang diambil dari database.
   */
  public function getLatarBelakang(): array
  {
    // Melakukan SELECT data pada database menggunakan baseModel.
    $this->baseModel->selectData();

    // Mengambil semua baris data yang dihasilkan dari SELECT.
    return $this->baseModel->fetch();
  }

  /**
   * Mengubah latar belakang pengguna berdasarkan data yang diberikan.
   *
   * @param array $data Data yang diberikan, berisi 'username' dan 'textarea'.
   * @return int Jumlah baris yang terpengaruh oleh operasi (INSERT atau UPDATE).
   */
  public function changeLatarBelakang($data): int
  {
    // Menyiapkan data yang akan dimasukkan atau diubah.
    $dataArray = [
      "username" => $data['username'],
      "content" => $data['textarea'],
      "datetime" => date('Y-m-d H:i:s')
    ];

    // Melakukan SELECT data pada database.
    $this->baseModel->selectData();
    $dataCount = $this->baseModel->fetchAll();

    if ($dataCount === 0) {
      // insert data
      return $this->baseModel->insertData($dataArray);
    } else {
      // update data
      return $this->baseModel->updateData($dataArray, ["id_latarbelakang" => 1]);
    }
  }
}
