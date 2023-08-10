<?php

class Transaksi extends Controller
{

    public function index($slug = null, $qty = null): void
    {
        // jika slug adalah zakat penghasilan dan tidak memiliki post hitung zakat
        if($slug === 'zakatpenghasilan' && !isset($_POST['hitung-zakat'])) {
            header("Location: " . BASEURL . '/perhitunganzakat');
            exit;
        }

        // cek nilai zakat
        $nilai_zakat = null;
        if(isset($_POST['hitung-zakat'])) {
            $nilai_zakat = $_POST['nilai-zakat'];
            $nilai_zakat = (int) str_replace(array('Rp', '.', ' '), '', $nilai_zakat);
            // jika nilai zakat tidak memenuhi nisab
            if($nilai_zakat < 150000) {
                Flasher::setFlash('Nilai zakat harus memenuhi nisab!', 'warning');
                header('Location: ' . BASEURL . '/perhitunganzakat');
                exit;
            }
            $data['nilai-zakat'] = $nilai_zakat;
        }

        // get data program by slug
        $dataProgram = $this->model('Program_model')->getDataProgramAktifBySlug($slug);

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
            "qtyFidyah" => $qty * 45000,
            "nilai-zakat" => $nilai_zakat
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

        // waktu expired dari kode
        $kode_expired = explode('_', $kode)[1] + (24 * 3600);

        // jika waktu saat ini telah lewat dari expired kode
        if(time() > $kode_expired) {
            Flasher::setFlash('Kode pembayaran sudah expired!', 'danger');
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
            "dataProgram" => $this->model('Program_model')->getDataProgramAktifBySlug($slug)
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
        $key    = $_POST['key'];
        $email  = $_POST['email'];

        $result = $this->model('Donatur_model')->tambahDataDonatur($_POST);

        if ($result > 0) {
            
            // get id donatur
            $id_donatur = $this->model('Kelolapembayaran_model')->getDataPembayaran('pending', 'nomor_pembayaran', $key)[0]['id_donatur'];
            
            $subject = 'Pembayaran Belum Terselesaikan';
            $message = Design::emailMessageSummary($id_donatur);
            
            // kirim pesan email
            $isEmail = Utility::sendEmail($email, $subject, $message);
            
            // jika email berhasil terkirim
            if($isEmail) {
                Flasher::setFlash('Cek Email Anda jika halaman ini hilang!', 'info');
                header("Location: " . BASEURL . '/transaksi/summary/' . $key);
                exit;
            }
            
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

    public function aksi_hapus_transaksi(): void 
    {
        $id = $_POST['id'];
        $result = $this->model('Kelolapembayaran_model')->hapusPembayaran($id);
        if($result > 0) {
            Flasher::setFlash('Transaksi pending berhasil dihapus!', 'success');
            header('Location: ' . BASEURL . '/user_dashboard/donasi_pending');
            exit;
        } else {
            Flasher::setFlash('Transaksi pending gagal dihapus!', 'danger');
            header('Location: ' . BASEURL . '/user_dashboard/donasi_pending');
            exit;
        }
    }
}
