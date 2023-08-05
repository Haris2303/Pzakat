<?php

class Web extends Controller {
  
  public function index(): void {
    $data = [
      "judul" => "Home",
      "donaturTerdaftar" => $this->model('Kelolapembayaran_model')->getDonaturTerdaftar(),
      "dataBerita"  => $this->model('Pageviews_model')->getAllDataBeritaLimit(3),
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikelLimit(4),
      "dataBanner" => $this->model('Banner_model')->getAllDataBanner(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllKategoriProgram('aktif'),
      "dataZakat" => $this->model('Kelolaprogram_model')->getDataProgramZakatLimit(1),
      "jumlahProgram" => count($this->model('Kelolaprogram_model')->getAllDataProgramAktifTunai()),
      "danaTerkumpul" => $this->model('Kelolapembayaran_model')->getDataPemasukkanHarian(),
      "src_video" => $this->model('Video_model')->getData()['link'],
      "laporan" => $this->model('Laporantahunan_model')->getDataLimit(3)
    ];
    $this->view('template/header', $data);
    $this->view('web/index', $data);
    $this->view('template/footer', $data);
  }

  public function getdataprogram(): void 
  {
    echo json_encode($this->model('Kelolaprogram_model')->getDataProgramLimitByJenisProgram(3, $_POST['name']));
  }

  public function getTemplate(): void
  {
    echo $this->view('template/spinner');
  }

  public function laporan(): void 
  {

  }

  public function profil(): void {
    $data['judul'] = 'Profile';
    $this->view('template/header', $data);
    $this->view('web/profil', $data);
    $this->view('template/footer', $data);
  }

}