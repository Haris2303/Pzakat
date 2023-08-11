<?php

class Transaksi extends Controller
{

    /**
     * Halaman index yang berhubungan dengan perhitungan zakat dan form donasi
     * @method index
     * @param string $slug Slug yang mengidentifikasi program
     * @param int $qty Jumlah quantity (opsional, default: null)
     */
    public function index($slug = null, $qty = null): void
    {
        // Jika slug adalah 'zakatpenghasilan' dan tidak ada post 'hitung-zakat', arahkan ke halaman perhitungan zakat
        if ($slug === 'zakatpenghasilan' && !isset($_POST['hitung-zakat'])) {
            header("Location: " . BASEURL . '/perhitunganzakat');
            exit;
        }

        // Cek nilai zakat
        $nilai_zakat = null;
        if (isset($_POST['hitung-zakat'])) {
            $nilai_zakat = $_POST['nilai-zakat'];
            $nilai_zakat = (int) str_replace(array('Rp', '.', ' '), '', $nilai_zakat);
            // Jika nilai zakat tidak memenuhi nisab (nisab zakat penghasilan adalah 150,000)
            if ($nilai_zakat < 150000) {
                Flasher::setFlash('Nilai zakat harus memenuhi nisab!', 'warning');
                header('Location: ' . BASEURL . '/perhitunganzakat');
                exit;
            }
            $data['nilai-zakat'] = $nilai_zakat;
        }

        // Dapatkan data program berdasarkan slug
        $dataProgram = $this->model('Program_model')->getDataProgramAktifBySlug($slug);

        // Jika halaman program tidak ditemukan
        if (is_bool($dataProgram)) {
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

    /**
     * Halaman summary untuk tampilan ringkasan pembayaran
     * @method summary
     * @param string $kode Kode pembayaran
     */
    public function summary($kode): void
    {
        // Dapatkan nominal pembayaran berdasarkan kode pembayaran
        $nominal = $this->model('Pembayaran_model')->getAllDataPembayaran('pending', [], ['nomor_pembayaran =' => $kode])[0]['jumlah_pembayaran'];

        // Jika kode pembayaran tidak valid (tidak ada nominal)
        if (is_null($nominal)) {
            header("Location: " . BASEURL . '/programs');
            exit;
        }

        // Waktu expired dari kode pembayaran
        $kode_expired = explode('_', $kode)[1] + (24 * 3600);

        // Jika waktu saat ini telah melewati waktu expired kode pembayaran
        if (time() > $kode_expired) {
            Flasher::setFlash('Kode pembayaran sudah expired!', 'danger', 'y');
            header("Location: " . BASEURL . '/programs');
            exit;
        }

        // Dapatkan ID bank berdasarkan kode pembayaran
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

    /**
     * Halaman form kuantitas (quantity) untuk jenis pembayaran tertentu pada program tertentu
     * @method qty
     * @param string $jenis Jenis pembayaran
     * @param string $slug Slug program
     */
    public function qty($jenis, $slug): void
    {
        // Siapkan data untuk view, termasuk judul halaman dan data program berdasarkan slug
        $data = [
            "judul" => "Form Quantity Fidyah",
            "dataProgram" => $this->model('Program_model')->getDataProgramAktifBySlug($slug)
        ];

        // Periksa apakah jenis pembayaran program sesuai dengan jenis yang diminta
        if ($data['dataProgram']['jenis_pembayaran'] === $jenis) {
            // Jika sesuai, muat view-template normalheader, halaman transaksi/qty, dan view-template normalfooter dengan menggunakan data yang telah disiapkan
            $this->view('template/normalheader', $data);
            $this->view('transaksi/qty', $data);
            $this->view('template/normalfooter', $data);
        } else {
            // Jika jenis pembayaran tidak sesuai, arahkan pengguna kembali ke halaman program
            header('Location: ' . BASEURL . '/programs');
            exit;
        }
    }

    /**
     * ----------------------------------------------------------------------------------------------------------------------------------
     *                  ACTION METHOD
     * ----------------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * Aksi untuk menambah data donatur dan mengirimkan email konfirmasi pembayaran
     * @method aksi_tambah_donatur
     */
    public function aksi_tambah_donatur()
    {
        $key = $_POST['key'];
        $email = $_POST['email'];

        // Menambahkan data donatur menggunakan model Donatur_model
        $result = $this->model('Donatur_model')->tambahData($_POST);

        if ($result > 0) {
            // Dapatkan id donatur berdasarkan nomor pembayaran (key)
            $id_donatur = $this->model('Pembayaran_model')->getAllDataPembayaran('pending', [], ["nomor_pembayaran =" => $key])[0]['id_donatur'];

            // Siapkan subjek dan pesan email untuk konfirmasi pembayaran
            $subject = 'Pembayaran Belum Terselesaikan';
            $message = Design::emailMessageSummary($id_donatur);

            // Kirim pesan email
            $isEmail = Utility::sendEmail($email, $subject, $message);

            // Jika email berhasil terkirim
            if ($isEmail) {
                // Set pesan flash, arahkan ke halaman summary dengan parameter key, dan keluar dari fungsi
                Flasher::setFlash('Cek Email Anda jika halaman ini hilang!', 'info', 'y');
                header("Location: " . BASEURL . '/transaksi/summary/' . $key);
                exit;
            }
        } else {
            // Jika gagal menambah data donatur, set pesan flash, arahkan kembali ke halaman transaksi, dan keluar dari fungsi
            Flasher::setFlash('Gagal', 'danger');
            header("location: " . BASEURL . '/transaksi');
            exit;
        }
    }

    /**
     * Aksi untuk menambah data transaksi pembayaran dan mengirimkan konfirmasi ke Admin
     * @method aksi_tambah_transaksi
     */
    public function aksi_tambah_transaksi(): void
    {
        // Konfirmasi data transaksi pembayaran menggunakan model Pembayaran_model
        $result = $this->model('Pembayaran_model')->konfirmasiDataTransaksi($_POST, $_FILES);

        if ($result > 0 && is_int($result)) {
            // Jika konfirmasi berhasil (nilai $result lebih dari 0 dan tipe data integer), set pesan flash sukses.
            Flasher::setFlash('Transaksi pembayaran <strong>berhasil</strong> dikirim, tunggu konfirmasi dari Admin!', 'success', 'y');
            // Arahkan pengguna ke halaman program.
            header("Location: " . BASEURL . "/programs");
            exit;
        } else {
            // Jika konfirmasi gagal, set pesan flash dengan pesan kesalahan.
            Flasher::setFlash('Transaksi <strong>Gagal</strong> Dikonfirmasi!', 'danger');
            // Arahkan pengguna kembali ke halaman program.
            header("Location: " . BASEURL . "/programs");
            exit;
        }
    }

    /**
     * Aksi untuk menghapus data transaksi pembayaran dengan status pending
     * @method aksi_hapus_transaksi
     */
    public function aksi_hapus_transaksi(): void
    {
        // Ambil ID transaksi dari data POST
        $id = $_POST['id'];

        // Hapus pembayaran dengan status pending menggunakan model Pembayaran_model
        $result = $this->model('Pembayaran_model')->hapusPembayaran($id);

        if ($result > 0) {
            // Jika penghapusan berhasil (nilai $result lebih dari 0), set pesan flash sukses.
            Flasher::setFlash('Transaksi pending berhasil dihapus!', 'success');
            // Arahkan pengguna ke halaman donasi pending pada user dashboard.
            header('Location: ' . BASEURL . '/user_dashboard/donasi_pending');
            exit;
        } else {
            // Jika penghapusan gagal, set pesan flash dengan pesan kesalahan.
            Flasher::setFlash('Transaksi pending gagal dihapus!', 'danger');
            // Arahkan pengguna kembali ke halaman donasi pending pada user dashboard.
            header('Location: ' . BASEURL . '/user_dashboard/donasi_pending');
            exit;
        }
    }
}
