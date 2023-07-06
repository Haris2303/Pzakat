<?php

class Kelola_program extends Controller
{

    /**
     * 
     * @method View
     * 
    */

    public function index(): void
    {
        $data = [
            "judul" => "Kelola Programs",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/index', $data);
        $this->view('dashboard/footer', $data);
    }

    public function zakat(): void
    {
        $data = [
            "judul" => "Kelola Zakat Uang",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataZakat" => $this->model('Kelolaprogram_model')->getAllDataProgramZakatTunai()
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
            "dataBarang" => $this->model('Kelolaprogram_model')->getAllDataProgramBarang()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/zakatbarang', $data);
        $this->view('dashboard/footer', $data);
    }

    public function infaq(): void
    {
        $data = [
            "judul" => "Kelola Infaq",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataInfaq" => $this->model('Kelolaprogram_model')->getAllDataProgramInfaq(),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/infaq', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    public function qurban(): void
    {
        $data = [
            "judul" => "Kelola Qurban",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
        ];

        $this->view("dashboard/sidebar", $data);
        $this->view("kelola_program/qurban", $data);
        $this->view("dashboard/footer", $data);
    }

    public function detail($slug): void
    {
        $data = [
            "judul" => "Detail Program",
            "css" => VENDOR_TABLES_CSS,
            "script" => VENDOR_TABLES,
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug),
            "programNameAktif" => $this->model('Kelolaprogram_model')->getAllProgramNameAktif()
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('kelola_program/detail', $data);
        $this->view('tinymce/tinymce');
        $this->view('dashboard/footer', $data);
    }

    public function getDataProgramHaveMoneyById()
    {
        echo json_encode($this->model('Kelolaprogram_model')->getAllDataProgramHaveMoneyById($_POST['id_program']));
    }

    public function getDataProgramByJenisProgram()
    {
        echo json_encode($this->model('Kelolaprogram_model')->getAllDataProgramAktifByJenisProgram($_POST['jenis_program']));
    }


    /**
     * 
     * @method aksi
     * 
     * @param NULL
     * 
    */

    public function aksi_tambah_zakatuang(): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataZakat($_POST, $_FILES);
        if($result > 0) {
            Flasher::setFlash('Data Zakat <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/kelola_program/zakat');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/kelola_program/zakat');
            exit;
        }
    }

    public function aksi_tambah_zakatbarang(): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataZakatBarang($_POST);
        if($result > 0) {
            Flasher::setFlash('Data Barang <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/kelola_program/zakatbarang');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/kelola_program/zakatbarang');
            exit;
        }
    }

    public function aksi_tambah_infaq(): void
    {
        $result = $this->model('Kelolaprogram_model')->tambahDataInfaq($_POST, $_FILES);
        if($result > 0) {
            Flasher::setFlash('Data Infaq <strong>Berhasil</strong> Ditambahkan!', 'success');
            header('Location: ' . BASEURL . '/kelola_program/infaq');
            exit;
        } else {
            Flasher::setFlash($result, 'danger');
            header('Location: ' . BASEURL . '/kelola_program/infaq');
            exit;
        }
    }
}
