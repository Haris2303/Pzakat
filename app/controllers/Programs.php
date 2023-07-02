<?php

class Programs extends Controller {

  public function index():void 
  {
    $data = [
      "judul" => "Programs",
      "dataProgram" => $this->model('Kelolaprogram_model')->getAllDataProgramAktifTunai(),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/index', $data);
    $this->view('template/footer', $data);
  }

  public function zakat(): void
  {
    $data = [
      "judul" => "Programs Zakat",
      "dataProgramZakat" => $this->model('Kelolaprogram_model')->getAllDataProgramZakat(),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/zakat', $data);
    $this->view('template/footer', $data);
  }

  public function infaq(): void
  {
    $data = [
      "judul" => "Programs Infaq",
      "dataProgramInfaq" => $this->model('Kelolaprogram_model')->getAllDataProgramInfaq(),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/infaq', $data);
    $this->view('template/footer', $data);
  }

}