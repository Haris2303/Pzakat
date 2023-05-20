<?php

class Masjid extends Controller
{

  public function index(): void
  {

    $data = [
      "judul" => 'Masjid',
      "css" => [
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "js/vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view("masjid/index", $data);
    $this->view('dashboard/footer', $data);
  }
}
