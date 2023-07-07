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
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi()),
      "sumDanaZakat"  => number_format($this->model('Kelolaprogram_model')->getSumProgramZakat()['total_dana'], 0, ',', '.'),
      "sumDanaInfaq"  => number_format($this->model('Kelolaprogram_model')->getSumProgramInfaq()['total_dana'], 0, ',', '.'),
      "sumDanaQurban"  => number_format($this->model('Kelolaprogram_model')->getSumProgramQurban()['total_dana'], 0, ',', '.'),
      "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
    ];
    $this->view('dashboard/sidebar', $data);
    $this->view('dashboard/index', $data);
    $this->view('dashboard/footer', $data);
  }

  public function getdatapemasukkan(): void 
  {
    echo json_encode($this->model('Dashboard_model')->getDataPemasukkan());
  }

}