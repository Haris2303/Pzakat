<?php

class Kelola_program extends Controller
{

    /**
     * Index: Menampilkan halaman kelola program.
     *
     * @return void
     */
    public function index(): void
    {
        // Jika yang mengakses bukan admin
        if ($_SESSION['level'] !== '1') {
            header('Location: ' . BASEURL . '/');
            exit;
        }

        // Mengambil data yang diperlukan
        $data = [
            "judul" => "Kelola Programs",
            "program" => $this->model('Kategoriprogram_model')->getAllKategoriProgram()
        ];

        // Menampilkan tampilan halaman kelola program
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Zakat: Menampilkan halaman kelola zakat uang.
     *
     * @return void
     */
    public function zakat(): void
    {
        $data = [
            "judul" => "Kelola Zakat Uang",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataZakat" => $this->model('Program_model')->getAllDataProgramTunai('zakat')
        ];

        // Menampilkan tampilan halaman kelola zakat uang
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakat', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * Zakat Barang: Menampilkan halaman kelola zakat barang.
     *
     * @return void
     */
    public function zakatbarang(): void
    {
        $data = [
            "judul" => "Kelola Zakat Barang",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataBarang" => $this->model('Program_model')->getAllDataProgramBarang('Zakat')
        ];

        // Menampilkan tampilan halaman kelola zakat barang
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakatbarang', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Infaq: Menampilkan halaman kelola infaq.
     *
     * @return void
     */
    public function infaq(): void
    {
        $data = [
            "judul" => "Kelola Infaq",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataInfaq" => $this->model('Program_model')->getAllDataProgramTunai('infaq'),
        ];

        // Menampilkan tampilan halaman kelola infaq
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/infaq', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * Qurban: Menampilkan halaman kelola qurban.
     *
     * @return void
     */
    public function qurban(): void
    {
        $data = [
            "judul" => "Kelola Qurban",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataQurban" => $this->model('Program_model')->getAllDataProgramTunai('qurban')
        ];

        // Menambahkan script tambahan ke array script
        $array = ["util" => "js/util/script.js"];
        $data['script'] = array_merge($data['script'], $array);

        // Menampilkan tampilan halaman kelola qurban
        $this->view("dashboard/sidebar", $data);
        $this->view("kelola_program/qurban", $data);
        $this->view("tinymce/tinymce");
        $this->view("dashboard/footer", $data);
    }

    /**
     * Donasi: Menampilkan halaman kelola donasi uang.
     *
     * @return void
     */
    public function donasi(): void
    {
        $data = [
            "judul" => "Kelola Donasi Uang",
            "css"   => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataDonasi" => $this->model('Program_model')->getAllDataProgramTunai('donasi')
        ];

        // Menampilkan tampilan halaman kelola donasi uang
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/donasi', $data);
        $this->view("tinymce/tinymce");
        $this->view('dashboard/footer', $data);
    }

    /**
     * DonasiBarang: Menampilkan halaman kelola donasi barang.
     *
     * @return void
     */
    public function donasibarang(): void
    {
        $data = [
            "judul" => "Kelola Donasi Barang",
            "css"   => VENDOR_TABLES_CSS,
            "dataBarang" => $this->model('Program_model')->getAllDataProgramBarang('Donasi')
        ];

        // Menampilkan tampilan halaman kelola donasi barang
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/donasibarang', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * Ramadhan: Menampilkan halaman kelola program donasi Ramadhan.
     *
     * @return void
     */
    public function ramadhan(): void
    {
        $data = [
            "judul" => "Kelola Ramadhan",
            "css"   => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataRamadhan" => $this->model('Program_model')->getAllDataProgramTunai('ramadhan')
        ];

        // Menampilkan tampilan halaman kelola program donasi Ramadhan
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/ramadhan', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * Detail: Menampilkan detail program donasi berdasarkan slug.
     *
     * @param string $slug Slug program donasi.
     * @return void
     */
    public function detail(string $slug = null): void
    {
        // Jika slug kosong/null, alihkan ke halaman utama
        if (is_null($slug)) {
            header('Location: ' . BASEURL . '/');
            exit;
        }

        // Mengambil data program donasi aktif berdasarkan slug
        $data = [
            "judul" => "Detail Program",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataProgram" => $this->model('Program_model')->getDataProgramAktifBySlug($slug),
        ];

        // Cek apakah data program ditemukan berdasarkan slug
        if (is_bool($data['dataProgram'])) {
            // Jika tidak ditemukan, tampilkan halaman 404 (Not Found)
            $this->view('error/404');
            exit;
        }

        // Tampilkan tampilan detail program donasi
        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/detail', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * GetDataProgramHaveMoneyById: Mengambil data program donasi yang memiliki informasi tentang donasi uang berdasarkan ID program.
     *
     * @return void
     */
    public function getDataProgramHaveMoneyById()
    {
        // Mengambil ID program dari data POST
        $id_program = $_POST['id_program'];

        // Mengambil data program donasi yang memiliki informasi tentang donasi uang berdasarkan ID program
        $data = $this->model('Program_model')->getAllDataProgramHaveMoneyById($id_program);

        // Mengirimkan data dalam format JSON
        echo json_encode($data);
    }

    /**
     * GetDataProgramByJenisProgram: Mengambil data program donasi berdasarkan jenis program tertentu.
     *
     * @return void
     */
    public function getDataProgramByJenisProgram()
    {
        // Mengambil jenis program dari data POST
        $jenis_program = $_POST['jenis_program'];

        // Mengambil data program donasi berdasarkan jenis program
        $data = $this->model('Program_model')->getAllDataProgramTunai($jenis_program);

        // Mengirimkan data dalam format JSON
        echo json_encode($data);
    }

    /**
     * ---------------------------------------------------------------------------------------------------------------------------
     *                  ACTION METHOD
     * ---------------------------------------------------------------------------------------------------------------------------
     */

    /**
     * AksiTambahBarang: Menambahkan data program donasi berupa barang.
     *
     * @param string $program Nama jenis program (misalnya "zakat", "infaq", "qurban", dll.).
     * @return void
     */
    public function aksi_tambah_barang(string $program): void
    {
        // Menambahkan data program donasi berupa barang
        $result = $this->model('Program_model')->tambahDataProgram(ucwords($program), $_POST);
        if (is_int($result) && $result > 0) {
            Flasher::setFlash('Data Barang <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . "/kelola_program/" . $program . "/barang");
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . "/kelola_program/" . $program . "/barang");
            exit;
        }
    }

    /**
     * AksiTambahProgram: Menambahkan data program donasi.
     *
     * @param string $program Nama jenis program (misalnya "zakat", "infaq", "qurban", dll.).
     * @return void
     */
    public function aksi_tambah_program(string $program): void
    {
        // Menambahkan data program donasi
        $result = $this->model('Program_model')->tambahDataProgram(ucwords($program), $_POST, $_FILES);
        if (is_int($result) && $result > 0) {
            Flasher::setFlash("Data $program <strong>Berhasil</strong> Ditambahkan!", 'success');
            header('Location: ' . BASEURL . "/kelola_program/$program");
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . "/kelola_program/$program");
            exit;
        }
    }

    /**
     * AksiStatusProgram: Mengubah status program donasi (aktif atau nonaktif).
     *
     * @return void
     */
    public function aksi_status_program(): void
    {
        // Tentukan status yang akan diubah (aktif menjadi pasif atau sebaliknya)
        $update_to = ($_POST['status'] === 'aktif') ? 'pasif' : 'aktif';
        $pesan = ($_POST['status'] === 'aktif') ? 'Nonaktifkan' : 'Aktifkan';

        // Mengubah status program menggunakan model Kategoriprogram_model
        $result = $this->model('Kategoriprogram_model')->ubahStatusProgram($_POST['id'], $update_to);

        // Set pesan flash berdasarkan hasil perubahan status
        if ($result > 0) {
            Flasher::setFlash('Status berhasil di ' . $pesan . '!', 'success');
            header('Location: ' . BASEURL . '/kelola_program');
            exit;
        } else {
            Flasher::setFlash('Status gagal di ' . $pesan . '!', 'danger');
            header('Location: ' . BASEURL . '/kelola_program');
            exit;
        }
    }
}
