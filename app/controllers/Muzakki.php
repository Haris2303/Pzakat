<?php

class Muzakki extends Controller {

  public function index(): void {

    $data = [
      "judul" => 'Muzakki',
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
      ],
      "script" => VENDOR_TABLES,
      "dataMuzakki" => $this->model('Muzakki_model')->getAllDataMuzakki(),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('muzakki/index', $data);
    $this->view('dashboard/footer', $data);

  }
  
}
