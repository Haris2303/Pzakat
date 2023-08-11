<?php

class Dashboard extends Controller
{

  /**
   * Metode index untuk menampilkan halaman dashboard.
   *
   * @return void
   */
  public function index(): void
  {
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
      "countKonfirmasi" => count($this->model('Pembayaran_model')->getAllDataPembayaran('konfirmasi')),
      "countMuzakki" => count($this->model("Muzakki_model")->getAllData()),
      "sumDanaZakat"  => $this->model('Program_model')->getSumProgram('zakat'),
      "sumDanaInfaq"  => $this->model('Program_model')->getSumProgram('infaq'),
      "sumDanaQurban"  => $this->model('Program_model')->getSumProgram('qurban'),
      "sumDanaDonasi"  => $this->model('Program_model')->getSumProgram('donasi'),
      "sumDanaRamadhan"  => $this->model('Program_model')->getSumProgram('ramadhan'),
    ];

    // Menampilkan bagian-bagian dari dashboard
    $this->view('dashboard/sidebar', $data);
    $this->view('dashboard/index', $data);
    $this->view('dashboard/footer', $data);
  }

  /**
   * Mendapatkan data pemasukkan bulanan dan mengirimkannya dalam format JSON.
   *
   * @return void
   */
  public function getDataPemasukkanBulanan(): void
  {
    // Mengambil data pemasukkan bulanan menggunakan model Pembayaran_model
    $dataPemasukkanBulanan = $this->model('Pembayaran_model')->getDataPemasukkanBulanan();

    // Mengirimkan data dalam format JSON
    echo json_encode($dataPemasukkanBulanan);
  }

  /**
   * Mendapatkan data pemasukkan harian dan mengirimkannya dalam format JSON.
   *
   * @return void
   */
  public function getDataPemasukkanHarian(): void
  {
    // Mengambil data pemasukkan harian menggunakan model Pembayaran_model
    $dataPemasukkanHarian = $this->model('Pembayaran_model')->getDataPemasukkanHarian();

    // Mengirimkan data dalam format JSON
    echo json_encode($dataPemasukkanHarian);
  }
}
