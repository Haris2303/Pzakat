<?php

class Dashboard extends Controller{

  public function index(): void {
    $data = [
      "judul" => 'Dashboard',
      "script" => [
        "vendor_chart"    => "vendor/chart.js/Chart.min.js",
        "demo_chartArea"  => "js/demo/chart-area-demo.js",
        "demo_chartPie"   => "js/demo/chart-pie-demo.js"
      ],
      "css" => [
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ],
      "dataKategoriProgram" => $this->model('Kategoriprogram_model')->getAllDataKategoriProgram()
    ];
    $this->view('dashboard/sidebar', $data);
    $this->view('dashboard/index', $data);
    $this->view('dashboard/footer', $data);
  }

}