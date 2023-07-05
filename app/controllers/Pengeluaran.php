<?php

class Pengeluaran extends Controller {

    public function index() :void 
    {
        $data = [
            "judul" => "Pengeluaran Tunai",
            "css" => VENDOR_TABLES_CSS,
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
                "util" => "js/util/script.js"
            ],
            "dataPengeluaran" => $this->model('Pengeluaran_model')->getAllDataPengeluaranTunai(),
            "dataProgram" => $this->model('Kelolaprogram_model')->getAllDataProgramHaveMoney(),
            "dataRekening" => $this->model('Norek_model')->getAllDataNorekHaveSaldo()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function barang(): void
    {
        $data = [
            "judul" => "Pengeluaran Barang",
            "css" => VENDOR_TABLES_CSS,
            "script" => [
                "vendor_datatables"     => "vendor/datatables/jquery.dataTables.min.js",
                "vendor_bootstraptable" => "vendor/datatables/dataTables.bootstrap4.min.js",
                "demo_datatables"       => "js/demo/datatables-demo.js",
                "util" => "js/util/script.js"
            ],
            "dataPengeluaran" => $this->model('Pengeluaran_model')->getAllDataPengeluaranBarang(),
            "dataBarang" => $this->model("Kelolaprogram_model")->getAllDataProgramBarang()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/barang', $data);
        $this->view('dashboard/footer', $data);
    }

    public function detailTunai($id): void
    {
        $data = [
            "judul" => "Detail Pengeluaran",
            "detail" => $this->model('Pengeluaran_model')->getDataPengeluaranById($id)
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/detailTunai', $data);
        $this->view('dashboard/footer', $data);
    }

    public function detailBarang($id): void
    {
        $data = [
            "judul" => "Detail Pengeluaran",
            "detail" => $this->model('Pengeluaran_model')->getDataPengeluaranBarangById($id)
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/detailBarang', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method Aksi
     * 
     */

    public function aksi_tambah_pengeluaran_tunai()
    {
        $result = $this->model('Pengeluaran_model')->tambahDataPengeluaranTunai($_POST);
        if($result > 0) {
            Flasher::setFlash('Data Pengeluaran <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/pengeluaran/index');
            exit;
        } else {
            Flasher::setFlash('Data Pengeluaran <strong>Gagal</strong> Ditambahkan!', 'danger');
            header('Location: ' . BASEURL . '/pengeluaran/index');
            exit;
        }
    }

    public function aksi_tambah_pengeluaran_barang()
    {
        $result = $this->model('Pengeluaran_model')->tambahDataPengeluaranBarang($_POST);
        if($result > 0) {
            Flasher::setFlash('Data Pengeluaran <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/pengeluaran/barang');
            exit;
        } else {
            Flasher::setFlash('Data Pengeluaran <strong>Gagal</strong> Ditambahkan!', 'danger');
            header('Location: ' . BASEURL . '/pengeluaran/barang');
            exit;
        }
    }

}