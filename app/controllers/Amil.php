<?php

class Amil extends Controller
{

  public function index(): void
  {
    $data = [
      "judul" => 'Amil',
      "css" => [
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.css",
        "vendor_fontawesome" => "vendor/fontawesome-free/css/all.min.css"
      ],
      "script" => [
        "vendor_datatables"     => "js/vendor/datatables/jquery.dataTables.min.js",
        "vendor_bootstraptable" => "js/vendor/datatables/dataTables.bootstrap4.min.js",
        "demo_datatables"       => "js/demo/datatables-demo.js",
      ],
      "dataAmil" => $this->model('Amil_model')->getAllDataAmil(),
      "dataMasjid" => $this->model('Masjid_model')->getDataMasjid()
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('amil/index', $data);
    $this->view('dashboard/footer', $data);
  }

  public function detail($username): void 
  {
    $data = [
      "judul" => "Detail Amil",
      "detail" => $this->model('Amil_model')->getDataAmilByUsername($username),
    ];
    $data['masjid'] = $this->model('Masjid_model')->getDataMasjidById($data['detail']['id_mesjid']);

    $this->view('dashboard/sidebar', $data);
    $this->view('amil/detail', $data);
    $this->view('dashboard/footer', $data);
  }

  // verifikasi amil
  public function verifikasi($id): void
  {
    if ($this->model('Amil_model')->verifikasi($id) > 0) {
      Flasher::setFlash('Verifikasi', 'Berhasil', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    } else {
      Flasher::setFlash('Verifikasi', 'Gagal', 'success');
      header('Location: ' . BASEURL . '/amil');
      exit;
    }
  }
}
