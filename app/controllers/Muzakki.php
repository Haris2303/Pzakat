<?php

class Muzakki extends Controller {

  public function index(): void {

    $data = [
      "judul" => 'Muzakki',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataMuzakki" => $this->model('Muzakki_model')->getAllData(),
      // "programNameAktif" => $this->model('Kelolaprogram_model')->getAllKategoriProgram('aktif')
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('muzakki/index', $data);
    $this->view('dashboard/footer', $data);

  }
  
}
