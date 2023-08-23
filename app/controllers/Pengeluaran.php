<?php

class Pengeluaran extends Controller
{

    /**
     * Menampilkan halaman pengeluaran tunai.
     *
     * @method index
     */
    public function index(): void
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

    /**
     * Menampilkan halaman pengeluaran barang.
     * 
     * @method barang
     */
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

    /**
     * Menampilkan detail pengeluaran tunai berdasarkan ID.
     *
     * @method detailTunai
     * @param mixed $id - ID pengeluaran tunai yang akan ditampilkan detailnya.
     */
    public function detailTunai($id = true): void
    {
        $data = [
            "judul" => "Detail Pengeluaran",
            "detail" => $this->model('Pengeluaran_model')->getDataPengeluaranTunaiById($id)
        ];

        // Jika halaman tidak ditemukan
        if (is_bool($data['detail'])) {
            $this->view('error/404');
            exit;
        }

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/detailTunai', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Menampilkan detail pengeluaran barang berdasarkan ID.
     * 
     * @method detailBarang
     * @param mixed $id - ID pengeluaran barang yang akan ditampilkan detailnya.
     */
    public function detailBarang($id = true): void
    {
        $data = [
            "judul" => "Detail Pengeluaran",
            "detail" => $this->model('Pengeluaran_model')->getDataPengeluaranBarangById($id)
        ];

        // Jika halaman tidak ditemukan
        if (is_bool($data['detail'])) {
            $this->view('error/404');
            exit;
        }

        $this->view('dashboard/sidebar', $data);
        $this->view('pengeluaran/detailBarang', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Aksi untuk menambah data pengeluaran tunai.
     *
     * @method aksi_tambah_pengeluaran_tunai
     */
    public function aksi_tambah_pengeluaran_tunai()
    {
        $result = $this->model('Pengeluaran_model')->tambahDataPengeluaranTunai($_POST);
        if ($result > 0) {
            Flasher::setFlash('Data Pengeluaran <strong>Berhasil</strong> Ditambahkan!', 'success');
        } else {
            Flasher::setFlash('Data Pengeluaran <strong>Gagal</strong> Ditambahkan!', 'danger');
        }

        header($this->location . '/pengeluaran/index');
        exit;
    }

    /**
     * Aksi untuk menambah data pengeluaran barang.
     *
     * @method aksi_tambah_pengeluaran_barang
     */
    public function aksi_tambah_pengeluaran_barang()
    {
        $result = $this->model('Pengeluaran_model')->tambahDataPengeluaranBarang($_POST);
        if ($result > 0) {
            Flasher::setFlash('Data Pengeluaran <strong>Berhasil</strong> Ditambahkan!', 'success');
        } else {
            Flasher::setFlash('Data Pengeluaran <strong>Gagal</strong> Ditambahkan!', 'danger');
        }

        header($this->location . '/pengeluaran/barang');
        exit;
    }
}
