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
      "dataProgramZakat" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('zakat'),
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
      "dataProgramInfaq" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('infaq'),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/infaq', $data);
    $this->view('template/footer', $data);
  }

  public function qurban(): void
  {
    $data = [
      "judul" => "Programs Qurban",
      "dataProgramQurban" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('qurban'),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/qurban', $data);
    $this->view('template/footer', $data);
  }

  public function donasi(): void
  {
    $data = [
      "judul" => "Programs Donasi",
      "dataProgramDonasi" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('donasi'),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/donasi', $data);
    $this->view('template/footer', $data);
  }

  public function ramadhan(): void
  {
    $data = [
      "judul" => "Programs Ramadhan",
      "dataProgramRamadhan" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('ramadhan'),
      "dataJenisProgramAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('template/header', $data);
    $this->view('programs/ramadhan', $data);
    $this->view('template/footer', $data);
  }

}