<?php

class Programs extends Controller {

  public function index():void 
  {
    $data = [
      "judul" => "Programs",
      "dataProgram" => $this->model('Program_model')->getAllData(['jenis_pembayaran <>' => 'barang']),
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];
    $this->view('template/header', $data);
    $this->view('programs/index', $data);
    $this->view('template/footer', $data);
  }

  public function zakat(): void
  {
    $data = [
      "judul" => "Programs Zakat",
      "dataProgramZakat" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "zakat"]),
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    if(count($data['dataProgramZakat']) <= 0) {
      $this->view('error/404');
      exit;
    }

    $this->view('template/header', $data);
    $this->view('programs/zakat', $data);
    $this->view('template/footer', $data);
  }

  public function infaq(): void
  {
    $data = [
      "judul" => "Programs Infaq",
      "dataProgramInfaq" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "infaq"]),
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    if(count($data['dataProgramInfaq']) <= 0) {
      $this->view('error/404');
      exit;
    }

    $this->view('template/header', $data);
    $this->view('programs/infaq', $data);
    $this->view('template/footer', $data);
  }

  public function qurban(): void
  {
    $data = [
      "judul" => "Programs Qurban",
      "dataProgramQurban" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "qurban"]),
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    if(count($data['dataProgramQurban']) <= 0) {
      $this->view('error/404');
      exit;
    }

    $this->view('template/header', $data);
    $this->view('programs/qurban', $data);
    $this->view('template/footer', $data);
  }

  public function donasi(): void
  {
    $data = [
      "judul" => "Programs Donasi",
      "dataProgramDonasi" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "donasi"]),
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    if(count($data['dataProgramDonasi']) <= 0) {
      $this->view('error/404');
      exit;
    }

    $this->view('template/header', $data);
    $this->view('programs/donasi', $data);
    $this->view('template/footer', $data);
  }

  public function ramadhan(): void
  {
    $data = [
      "judul" => "Programs Ramadhan",
      "dataProgramRamadhan" => $this->model('Program_model')->getAllData(["logic" => "AND", "jenis_pembayaran <>" => "barang", "nama_kategoriprogram =" => "ramadhan"]),
      "dataJenisProgramAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif')
    ];

    if(count($data['dataProgramRamadhan']) <= 0) {
      $this->view('error/404');
      exit;
    }

    $this->view('template/header', $data);
    $this->view('programs/ramadhan', $data);
    $this->view('template/footer', $data);
  }

}