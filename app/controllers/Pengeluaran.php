<?php

class Pengeluaran extends Controller {

    public function index() :void 
    {
        $data = [
            "judul" => "Pengeluaran Tunai",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataPengeluaran" => $this->model('Pengeluaran_model')->getAllDataPengeluaranTunai(),
            "dataProgram" => $this->model('Program_model')->getAllDataProgramHaveMoney(),
            "dataRekening" => $this->model('Norek_model')->getAllDataNorekHaveSaldo()
        ];
        $data["script"] += ["util" => "js/util/script.js"];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/index', $data);
        $this->view('dashboard/footer', $data); 
    }

    public function barang(): void
    {
        $data = [
            "judul" => "Pengeluaran Barang",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataPengeluaran" => $this->model('Pengeluaran_model')->getAllDataPengeluaranBarang(),
            "dataBarang" => $this->model("Program_model")->getAllDataProgramBarang()
        ];
        $data["script"] += ["util" => "js/util/script.js"];

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/barang', $data);
        $this->view('dashboard/footer', $data);
    }

    public function detailTunai($id = true): void
    {
        $data = [
            "judul" => "Detail Pengeluaran",
            "detail" => $this->model('Pengeluaran_model')->getDataPengeluaranTunaiById($id)
        ];

        // jika halaman tidak ditemukan
        if(is_bool($data['detail'])) {
            $this->view('error/404');
            exit;
        }

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/detailTunai', $data);
        $this->view('dashboard/footer', $data);
    }

    public function detailBarang($id = true): void
    {
        $data = [
            "judul" => "Detail Pengeluaran",
            "detail" => $this->model('Pengeluaran_model')->getDataPengeluaranBarangById($id)
        ];

        // jika halaman tidak ditemukan
        if(is_bool($data['detail'])) {
            $this->view('error/404');
            exit;
        }

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