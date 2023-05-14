<?php

class Amil extends Controller {

  public function index(): void {
    $data = [
      "judul" => 'Amil',
      "css" => [
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.css",
      ],
      "script" => [
        "vendor_datatables"     => "js/vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataAmil" => $this->model('Amil_model')->getAllDataAmil()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('amil/index', $data);
    $this->view('dashboard/footer', $data);
  }

}