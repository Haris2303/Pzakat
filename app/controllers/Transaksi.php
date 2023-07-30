<?php

class Transaksi extends Controller
{

    public function index($program = null, $slug = null, $qty = null): void
    {
        $dataProgram = $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug);
        // jika halaman tidak ditemukan
        if(is_bool($dataProgram)) {
            $this->view('error/404');
            exit;
        }
        
        $data = [
            "judul" => "Form Donasi",
            "dataProgram" => $dataProgram,
            "dataNorek" => $this->model('Norek_model')->getAllDataNorekByProgram($dataProgram['jenis_program']),
            "dataKey" => Utility::getKeyRandom(),
            "qtyFidyah" => $qty * 45000
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/index', $data);
        $this->view('template/normalfooter', $data);
    }

    public function summary($kode): void
    {

        // get nominal
        $nominal = $this->model('Kelolapembayaran_model')->getDataPembayaran('pending', 'nomor_pembayaran', $kode)[0]['jumlah_pembayaran'];

        // jika kode valid
        if(is_null($nominal)) {
            header("Location: " . BASEURL . '/programs');
            exit;
        }

        // get id bank
        $id_bank = $this->model('Donatur_model')->getIdBankByKode($kode);


        $data = [
            "judul" => "Summary",
            "dataKode" => $kode,
            "nominal" => $nominal,
            "dataBank" => $this->model('Norek_model')->getDataNorekById($id_bank),
        ];

        $this->view('template/normalheader', $data);
        $this->view('transaksi/summary', $data);
        $this->view('template/normalfooter', $data);
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
        
        $result = $this->model('Transaksi_model')->konfirmasiDataTransaksi($_POST, $_FILES);
        if ($result > 0 && is_int($result)) {
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
