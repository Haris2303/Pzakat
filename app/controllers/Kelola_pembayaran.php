<?php

class Kelola_pembayaran extends Controller {

  public function index(): void
  {
    $data = [
      "judul" => "Kelola Data Pembayaran",
      "css" => [
        "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
          "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
          "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
          "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataPembayaran" => $this->model('Kelolapembayaran_model')->getAllDataPembayaran(),
      "countKonfirmasi" => count($this->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi())
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('kelola_pembayaran/index', $data);
    $this->view('dashboard/footer', $data);
  }

  public function detail($id): void
  {
      $data = [
          "judul" => "Detail Pembayaran",
          "detail" => $this->model('Kelolapembayaran_model')->getDataPembayaranById($id)
      ];

      $this->view('dashboard/sidebar', $data);
      $this->view('kelola_pembayaran/detail', $data);
      $this->view('dashboard/footer', $data);
  }

  public function pending(): void
  {
      $data = [
          "judul" => "Pembayaran Pending",
          "css" => [
              "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
              "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
              "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
              "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
              "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataPending" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranPending()
      ];

      $this->view('dashboard/sidebar', $data);
      $this->view('kelola_pembayaran/pending', $data);
      $this->view('dashboard/footer', $data);

  }

  public function konfirmasi(): void
  {
      $data = [
          "judul" => "Pembayaran Konfirmasi",
          "css" => [
              "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
              "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
              "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
              "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
              "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataKonfirmasi" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranKonfirmasi()
      ];

      $this->view('dashboard/sidebar', $data);
      $this->view('kelola_pembayaran/konfirmasi', $data);
      $this->view('dashboard/footer', $data);

  }

  public function berhasil(): void
  {
      $data = [
          "judul" => "Pembayaran Berhasil",
          "css" => [
              "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.css",
              "vendor_fontawesome"    => "vendor/fontawesome-free/css/all.min.css"
            ],
            "script" => [
              "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
              "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
              "demo_datatables"       => "js/demo/datatables-demo.js",
            ],
            "dataSukses" => $this->model("Kelolapembayaran_model")->getAllDataPembayaranSukses()
      ];

      $this->view('dashboard/sidebar', $data);
      $this->view('kelola_pembayaran/berhasil', $data);
      $this->view('dashboard/footer', $data);
  }

  public function aksi_konfirmasi_pembayaran($id, $username): void
  {
    $result = $this->model('Kelolapembayaran_model')->konfirmasiPembayaran($id, $username);
    if($result > 0) {
      Flasher::setFlash('Pembayaran <strong>Berhasil</strong> Dikonfirmasi!', 'success');
      header('Location: ' . BASEURL . '/kelola_pembayaran');
      exit;
    } else {
      Flasher::setFlash('Pembayaran <strong>Gagal</strong> Dikonfirmasi!', 'danger');
      header('Location: ' . BASEURL . '/kelola_pembayaran');
      exit;
    }
  }

  public function aksi_batal_pembayaran($id, $username): void
  {
    $result = $this->model('Kelolapembayaran_model');
  }

}