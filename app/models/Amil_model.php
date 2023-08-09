<?php

class Amil_model
{

  private $view   = 'vwAllAmil';
  private $baseModel;

  // constructor
  public function __construct()
  {
    $this->baseModel = new BaseModel($this->view);
  }


  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  GET ALL DATA
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * Mengambil seluruh data yang tersedia.
   *
   * @return array Data yang berisi semua entri yang tersedia.
   */
  public function getAllData(): array
  {
    $this->baseModel->selectData();
    return $this->baseModel->fetchAll();
  }


  /**
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   *                  GET DATA BY
   * -------------------------------------------------------------------------------------------------------------------------------------------------------
   */

  /**
   * Mengambil data berdasarkan username Amil.
   *
   * @param string $username Username Amil yang akan digunakan untuk mencari data.
   * @return array Data yang cocok dengan username yang diberikan.
   */
  public function getDataByUsername(string $username): array
  {
    $this->baseModel->selectData(null, null, [], ["username = " => $username]);
    return $this->baseModel->fetch();
  }
}
