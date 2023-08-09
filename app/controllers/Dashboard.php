<?php

class Dashboard extends Controller{

  public function index(): void {
    $data = [
      "judul" => 'Dashboard',
      "css" => [
        "calendar" => "css/util/calendar.css"
      ],
      "script" => [
        "vendor_chart"    => "vendor/chart.js/Chart.min.js",
        "demo_chartArea"  => "js/demo/chart-area-demo.js",
        "demo_chartPie"   => "js/demo/chart-pie-demo.js",
        "js_utility"      => "js/util/script.js"
      ],
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi()),
      "sumDanaZakat"  => $this->model('Program_model')->getSumProgram('zakat'),
      "sumDanaInfaq"  => $this->model('Program_model')->getSumProgram('infaq'),
      "sumDanaQurban"  => $this->model('Program_model')->getSumProgram('qurban'),
      "sumDanaDonasi"  => $this->model('Program_model')->getSumProgram('donasi'),
      "sumDanaRamadhan"  => $this->model('Program_model')->getSumProgram('ramadhan'),
    ];
    $this->view('dashboard/sidebar', $data);
    $this->view('dashboard/index', $data);
    $this->view('dashboard/footer', $data);
  }

  public function getDataPemasukkanBulanan(): void 
  {
    echo json_encode($this->model('Kelolapembayaran_model')->getDataPemasukkanBulanan());
  }

  public function getDataPemasukkanHarian(): void 
  {
    echo json_encode($this->model('Kelolapembayaran_model')->getDataPemasukkanHarian());
  }

}