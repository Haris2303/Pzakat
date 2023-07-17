<?php

//include master file
require_once(LOCALE_URL . '/report/cetak/fpdf/fpdf.php');

class LaporanProgram extends FPDF
{

    private $data = NULL; // data untuk content pada tabel
    private $nama_program = ''; // nama program pada content

    public function __construct(string $nama_program, array $data)
    {
        parent::__construct();
        $this->nama_program = $nama_program;
        $this->data = $data;
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
    }

    public function content()
    {
        $this->Ln(10);
        
        $h1 = 8;
        $w1 = 10;
        $w2 = 40;
        $w3 = 40;

        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(180, 0, 'Sorong, ' .date('d M Y'), 0, 1, 'R');
        $this->Ln(15);

        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 0, 'Data Program ' . $this->nama_program, 0, 1, 'C');
        $this->Ln(10);

        // Header tabel
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(10);
        $this->Cell($w1, $h1, 'No', 1, 0, 'C');
        $this->Cell($w2, $h1, 'Nama Program', 1, 0);
        $this->Cell($w2, $h1, 'Pemasukkan ', 1, 0);
        $this->Cell($w2, $h1, 'Pengeluaran', 1, 0);
        $this->Cell($w3, $h1, 'Total', 1, 1);

        $this->SetFont('helvetica', '', 11);

        $no = 1;
        $jumlah = 0;
        foreach($this->data as $item) {
            $this->Cell(10);
            $this->Cell($w1, $h1, $no++, 1, 0, 'C');
            $this->Cell($w2, $h1, $item['nama_program'], 1, 0);
            $this->Cell($w2, $h1, 'Rp '.number_format($item['pemasukkan'], 0, ',', '.'), 1, 0);
            $this->Cell($w2, $h1, 'Rp '. number_format($item['pengeluaran'], 0, ',', '.'), 1, 0);
            $this->Cell($w3, $h1, 'Rp '. number_format($item['total'], 0, ',', '.'), 1, 1);
            $jumlah += $item['total'];
        }
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(10);
        $this->Cell($w1 + $w2 + $w2 + $w2, $h1, 'Jumlah: ', 1, 0, 'C');
        $this->Cell($w3, $h1, 'Rp ' . number_format($jumlah, 0, ',', '.'), 1, 1);
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