<?php

class Web extends Controller {
  
  public function index(): void {
    $data = [
      "judul" => "Home",
      "donaturTerdaftar" => $this->model('Pembayaran_model')->getDonaturTerdaftar(),
      "dataBerita"  => $this->model('Pageviews_model')->getAllDataBeritaLimit(3),
      "dataArtikel" => $this->model('Pageviews_model')->getAllDataArtikelLimit(4),
      "dataBanner" => $this->model('Banner_model')->getAllDataBanner(),
      "programNameAktif" => $this->model('Kategoriprogram_model')->getAllKategoriProgram('aktif'),
      "dataZakat" => $this->model('Program_model')->getDataProgramZakatLimit(1),
      "jumlahProgram" => count($this->model('Program_model')->getAllDataProgramAktifTunai()),
      "danaTerkumpul" => $this->model('Pembayaran_model')->getDataPemasukkanHarian(),
      "src_video" => $this->model('Video_model')->getData()['link'],
      "laporan" => $this->model('Laporantahunan_model')->getDataLimit(3)
    ];
    $this->view('template/header', $data);
    $this->view('web/index', $data);
    $this->view('template/footer', $data);
  }

  public function getdataprogram(): void 
  {
    echo json_encode($this->model('Program_model')->getDataProgramLimitByJenisProgram(3, $_POST['name']));
  }

  public function getTemplate(): void
  {
    echo $this->view('template/spinner');
  }

  public function search(string $keyword = '') {
    $replaceKey = str_replace('-', ' ', $keyword);
    $data = [
      "program" => $this->model('Program_model')->getDataProgramAktifByKeyword($replaceKey),
      "berita" => $this->model('Pageviews_model')->getDataBeritaByKeyword($replaceKey),
      "artikel" => $this->model('Pageviews_model')->getDataArtikelByKeyword($replaceKey)
    ];
    $this->view('template/search', $data);
  }

  public function profil(): void {
    $data['judul'] = 'Profile';
    $this->view('template/header', $data);
    $this->view('web/profil', $data);
    $this->view('template/footer', $data);
  }

  public function testing(): void {
    $data = [
      "judul" => "Testing"
    ];

    $this->view('template/header', $data);
    $this->view('web/testing');
    $this->view('template/footer');
  }

}