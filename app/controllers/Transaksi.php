<?php

class Transaksi extends Controller
{

    public function index($program, $slug, $qty = null): void
    {

        $data = [
            "judul" => "Form Donasi",
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug),
            "dataNorek" => $this->model('Norek_model')->getAllDataNorekByProgram($program),
            "dataKey" => Utility::getKeyRandom(),
            "qtyFidyah" => $qty * 45000
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

        if ($kode === $_COOKIE['keyRandom']) {
            $this->view('template/normalheader', $data);
            $this->view('transaksi/summary', $data);
            $this->view('template/normalfooter', $data);
        } else {
            header("Location: " . BASEURL . '/');
            exit;
        }
    }

    public function qty($jenis, $slug): void
    {

        $data = [
            "judul" => "Form Quantity Fidyah",
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug)
        ];

        if ($data['dataProgram']['jenis_pembayaran'] === $jenis) {
            $this->view('template/normalheader', $data);
            $this->view('transaksi/qty', $data);
            $this->view('template/normalfooter', $data);
        } else {
            header('Location: ' . BASEURL . '/programs');
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
        setcookie('keyRandom', $key, time() + (24 * 3600));
        $result = $this->model('Donatur_model')->tambahDataDonatur($_POST);
        if ($result > 0) {
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
        // hapus cookie
        setcookie('nominal-donasi', 0, time() - 3600);
        setcookie('id-bank', 0, time() - 3600);
        setcookie('kode-pembayaran', '', time() - 3600);
        setcookie('keyRandom', '', time() - 3600);
        
        $result = $this->model('Transaksi_model')->konfirmasiDataTransaksi($_POST, $_FILES);
        if ($result > 0) {
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
