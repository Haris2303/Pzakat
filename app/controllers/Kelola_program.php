<?php

class Kelola_program extends Controller
{

    /**
     * 
     * @method Index
     * 
    */

    public function index(): void
    {
        // jika yang akses bukan admin
        if($_SESSION['level'] !== '1') {
            header('Location: ' . BASEURL . '/');
            exit;
        }
        
        $data = [
            "judul" => "Kelola Programs",
            "program" => $this->model('Kelolaprogram_model')->getAllKategoriProgram()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/index', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method Zakat
     * 
    */

    public function zakat(): void
    {
        $data = [
            "judul" => "Kelola Zakat Uang",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataZakat" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('zakat')
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakat', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }
    
    public function zakatbarang(): void
    {
        $data = [
            "judul" => "Kelola Zakat Barang",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataBarang" => $this->model('Kelolaprogram_model')->getAllDataProgramBarang('Zakat')
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakatbarang', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method Infaq
     * 
    */

    public function infaq(): void
    {
        $data = [
            "judul" => "Kelola Infaq",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataInfaq" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('infaq'),
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/infaq', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method Qurban
     * 
    */

    public function qurban(): void
    {

        $data = [
            "judul" => "Kelola Qurban",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataQurban" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('qurban')
        ];
        $array = ["util" => "js/util/script.js"];
        $data['script'] = array_merge($data['script'], $array);

        $this->view("dashboard/sidebar", $data);
        $this->view("kelola_program/qurban", $data);
        $this->view("tinymce/tinymce");
        $this->view("dashboard/footer", $data);
    }

    /**
     * 
     * @method Donasi
     * 
    */
    public function donasi(): void {
        $data = [
            "judul" => "Kelola Donasi Uang",
            "css"   => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataDonasi" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('donasi')
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/donasi', $data);
        $this->view("tinymce/tinymce");
        $this->view('dashboard/footer', $data);
    }

    public function donasibarang(): void {
        $data = [
            "judul" => "Kelola Donasi Barang",
            "css"   => VENDOR_TABLES_CSS,
            "dataBarang" => $this->model('Kelolaprogram_model')->getAllDataProgramBarang('Donasi')
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/donasibarang', $data);
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method Ramadhan
     * 
     */
    public function ramadhan(): void {
        $data = [
            "judul" => "Kelola Ramdhan",
            "css"   => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataRamadhan" => $this->model('Kelolaprogram_model')->getAllDataProgramTunai('ramadhan')
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/ramadhan', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method detail
     * @param Slug Type String
     * 
    */
    public function detail(string $slug = null): void
    {
        // jika slug null
        if(is_null($slug)) {
            header('Location: ' . BASEURL . '/');
            exit;
        }

        $data = [
            "judul" => "Detail Program",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramAktifBySlug($slug),
        ];

        // cek data model
        if(is_bool($data['dataProgram'])) {
            $this->view('error/404');
            exit;
        }

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/detail', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    /**
     * 
     * @method Get Data Json Type
     * 
    */

    public function getDataProgramHaveMoneyById()
    {
        echo json_encode($this->model('Kelolaprogram_model')->getAllDataProgramHaveMoneyById($_POST['id_program']));
    }

    public function getDataProgramByJenisProgram()
    {
        echo json_encode($this->model('Kelolaprogram_model')->getAllDataProgramTunai($_POST['jenis_program']));
    }


    /**
     * 
     * @method aksi
     * 
     * @param NULL
     * 
    */

    public function aksi_tambah_barang(string $program): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataProgram(ucwords($program), $_POST);
        if(is_int($result) && $result > 0) {
            Flasher::setFlash('Data Barang <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . "/kelola_program//" .$program. "barang");
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/kelola_program//' .$program. 'barang');
            exit;
        }
    }

    public function aksi_tambah_program(string $program): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataProgram(ucwords($program), $_POST, $_FILES);
        if(is_int($result) && $result > 0) {
            Flasher::setFlash("Data $program <strong>Berhasil</strong> Ditambahkan!", 'success');
            header('Location: ' . BASEURL . "/kelola_program/$program");
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . "/kelola_program/$program");
            exit;
        }
    }

    public function aksi_status_program(): void
    {
        $update_to = ($_POST['status'] === 'aktif') ? 'pasif' : 'aktif';
        $pesan = ($_POST['status'] === 'aktif') ? 'Nonaktifkan' : 'Aktifkan';
        $result = $this->model('Kelolaprogram_model')->ubahStatusProgram($_POST['id'], $update_to);
        if($result > 0) {
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
