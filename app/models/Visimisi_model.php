<?php

class Visimisi_model
{

  private $table = 'tb_visimisi';
  private $baseModel;

  public function __construct()
  {
    $this->baseModel = new BaseModel($this->table);
  }

  /**
   * Mengambil data visi dan misi dari basis data.
   *
   * @return array Data visi dan misi dalam bentuk array asosiatif.
   */
  public function getVisiMisi(): array
  {
    $this->baseModel->selectData();
    return $this->baseModel->fetch();
  }

  /**
   * Menambah atau mengubah visi dan misi dalam basis data.
   *
   * @param array $data Data visi dan misi yang akan ditambahkan atau diubah.
   * @return int Jumlah baris yang berhasil diubah atau ditambahkan.
   */
  public function changeVisiMisi(array $data): int
  {

    // data insert
    $dataInsert = [
      "username" => "Admin",
      "content" => $data['textarea'],
      "datetime" => date('Y-m-d H:i:s')
    ];

    // Mengambil jumlah data saat ini
    $this->baseModel->selectData();
    $dataCount = count($this->baseModel->fetchAll());

    if ($dataCount === 0) {
      // Jika tidak ada data, lakukan insert
      return $this->baseModel->insertData($dataInsert);
    } else {
      // Jika ada data, lakukan update dengan id_visimisi = 2
      return $this->baseModel->updateData(["content" => $data['textarea'], "datetime" => date('Y-m-d H:i:s')], ["id_visimisi" => 2]);
    }
  }
}
