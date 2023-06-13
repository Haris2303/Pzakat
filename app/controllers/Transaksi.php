<?php

class Transaksi extends Controller {

    public function index($slug): void 
    {
        $data = [
            "judul" => "Form Donasi",
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug),
            "dataNorek" => $this->model('Norek_model')->getAllDataNorek(),
            "dataKey" => Utility::getKeyRandom()
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/index', $data);
        $this->view('template/normalfooter', $data);
    }

    public function summary($kode): void 
    {
        $data = [
            "judul" => "Summary",
            "dataBank" => $this->model('Norek_model')->getDataNorekById($_COOKIE['id-bank'])
        ];

        if($kode === $_COOKIE['keyRandom']) {
            $this->view('template/normalheader', $data);
            $this->view('transaksi/summary', $data);
            $this->view('template/normalfooter', $data);
        } else {
            header("Location: " . BASEURL . '/');
            exit;
        }
    }


    /**
     * 
     * @param AksiTambahData
     * 
     */
    
    public function aksi_tambah_donatur()
    {
        $this->model('Transaksi_model')->setCookieKodePembayaran();
        $key = $_POST['key'];
        $result = $this->model('Donatur_model')->tambahDataDonatur($_POST);
        if($result > 0) {
            Flasher::setFlash('Berhasil', 'success');
            header("Location: " . BASEURL . '/transaksi/summary/' . $key);
            exit;
        } else {
            Flasher::setFlash('Gagal', 'danger');
            header("location: " . BASEURL . '/transaksi');
            exit;
        }
    }

    public function aksi_tambah_transaksi(): void
    {
        $result = $this->model('Transaksi_model')->konfirmasiDataTransaksi($_POST, $_FILES);
        if($result > 0){
            Flasher::setFlash('Transaksi <strong>Berhasil</strong> Dikonfirmasi!', 'success');
            header("Location: " . BASEURL . "/programs");
            exit;
        } else {
            Flasher::setFlash('Transaksi <strong>Gagal</strong> Dikonfirmasi!', 'danger');
            header("Location: " . BASEURL . "/programs");
            exit;
        }
    }

}