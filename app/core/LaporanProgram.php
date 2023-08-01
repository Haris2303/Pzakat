<?php

//include master file
require_once(LOCALE_URL . '/report/cetak/fpdf/fpdf.php');

class LaporanProgram extends FPDF
{

    private $jenis_program = ''; // jenis program pada content
    private $model;

    public function __construct(string $jenis_program)
    {
        parent::__construct();
        $this->jenis_program = $jenis_program;
        $this->model = new Laporan_model();
    }

    public function letak($gambar)
    {
        //memasukkan gambar untuk header
        $this->Image($gambar, 25, 5, 30, 30);
        //menggeser posisi sekarang
    }
    public function judul($teks1, $teks2, $teks3, $teks4, $teks5)
    {
        $this->Cell(25);
        $this->SetFont('Times', 'B', '14');
        $this->Cell(0, 5, $teks1, 0, 1, 'C');
        $this->Ln(2);
        $this->Cell(25);
        $this->Cell(0, 5, $teks2, 0, 1, 'C');
        $this->Ln(2);
        $this->Cell(25);
        $this->SetFont('Times', 'B', '16');
        $this->Cell(0, 5, $teks3, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('Times', 'I', '8');
        $this->Cell(0, 5, $teks4, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 2, $teks5, 0, 1, 'C');
    }
    public function garis()
    {
        $this->SetLineWidth(1);
        $this->Line(20, 39, 190, 39);
        $this->SetLineWidth(0);
        $this->Line(20, 40, 190, 40);

        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(180, 20, 'Sorong, ' .date('d M Y'), 0, 1, 'R');
        $this->Ln(-10);
    }

    public function blackContent() {
        $view = new Controller();
        echo $view->view('error/404', ["msg" => "Tidak ada data..."]);
        exit;
    }

    public function setContent(array $data, string $jenis_pembayaran) {
        $this->Ln(20);
            
        $h1 = 8;
        $w1 = 10;
        $w2 = 40;
        $w3 = 40;

        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 0, 'Data Program ' . $this->jenis_program . " $jenis_pembayaran", 0, 1, 'C');
        $this->Ln(10);

        // Header tabel
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(10);
        $this->Cell($w1, $h1, 'No', 1, 0, 'C');
        $this->Cell($w2, $h1, 'Nama Program', 1, 0);
        $this->Cell($w2, $h1, 'Pemasukkan ', 1, 0);
        $this->Cell($w2, $h1, 'Pengeluaran', 1, 0);
        $this->Cell($w3, $h1, 'Total', 1, 1);

        $this->SetFont('helvetica', '', 10);

        $no = 1;
        $jumlah = 0;
        foreach($data as $item) {
            $this->Cell(10);
            $this->Cell($w1, $h1, $no++, 1, 0, 'C');
            $this->Cell($w2, $h1, $item['nama_program'], 1, 0);
            $this->Cell($w2, $h1, 'Rp '.number_format($item['pemasukkan'], 0, ',', '.'), 1, 0);
            $this->Cell($w2, $h1, 'Rp '. number_format($item['pengeluaran'], 0, ',', '.'), 1, 0);
            $this->Cell($w3, $h1, 'Rp '. number_format($item['total'], 0, ',', '.'), 1, 1);
            $jumlah += $item['total'];
        }
        $this->SetFont('helvetica', 'B', 11);
        $this->Cell(10);
        $this->Cell($w1 + $w2 + $w2 + $w2, $h1, 'Jumlah: ', 1, 0, 'C');
        $this->Cell($w3, $h1, 'Rp ' . number_format($jumlah, 0, ',', '.'), 1, 1);
    }

    public function content(array $data)
    {
        $jenis_uang = null;
        $jenis_barang = null;

        // jika ada kosong
        if(count($data) <= 0) {
            $this->blackContent();
        }

        foreach($data as $d) {
            if(in_array('uang', $d)) { 
                $jenis_uang = 'uang';
            };
            if(in_array('barang', $d)) { 
                $jenis_barang = 'barang';
            };
        }
        
        if(!is_null($jenis_uang)) {
            $data = $this->model->getLaporan($this->jenis_program, $jenis_uang);
            $this->setContent($data, 'Uang');
        }

        if(!is_null($jenis_barang)) {
            $data = $this->model->getLaporan($this->jenis_program, $jenis_barang);
            $this->setContent($data, 'Barang');
        }
    }

    public function akhir()
    {
        $w = 180;
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell($w, 25, 'Kepala Organisasi', 0, 1, 'R');
        $this->Ln(15);
        $this->Cell($w, 0, 'Dr. Irene S. Dawenan', 0, 1, 'R');
        $this->Cell($w, 10, 'NRP. 20170526001', 0, 1, 'R');
    }
}