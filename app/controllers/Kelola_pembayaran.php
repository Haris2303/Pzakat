<?php

class Kelola_pembayaran extends Controller {

    public function detail($id)
    {
        $data = [
            "judul" => "Detail Pembayaran",
            "detail" => $this->model('Kelolapembayaran_model')->getDataPembayaranById($id)
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_pembayaran/detail', $data);
        $this->view('dashboard/footer', $data);
    }

    public function pending() 
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

    public function konfirmasi() 
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

    public function berhasil()
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

}