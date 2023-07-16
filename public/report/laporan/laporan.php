<?php
// include master file
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once('../assets/TCPDF-main/TCPDF-main/tcpdf.php');
// use APP\TCPDF\TCPDF;

class pdf extends TCPDF
{
    function letak($gambar)
    {
        // memasukkan gambar untuk header
        $this->Image($gambar, 10, 10, 20, 15);
        // menggeser posisi sekarang
    }

    function judul($teks1, $teks4, $teks5)
    {
        $this->Cell(25);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 5, $teks1, 0, 1, 'C');
        $this->Cell(25);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 5, $teks4, 0, 1, 'C');
        $this->Cell(25);
        $this->Cell(0, 2, $teks5, 0, 1, 'C');
    }

    function garis()
    {
        $this->SetLineWidth(1);
        $this->Line(10, 26, 138, 26);
        $this->SetLineWidth(0);
        $this->Line(10, 27, 138, 27);

    }

    function Content()
    {
        $gh = $_GET['id'];
        $this->Ln(10);

        // Header tabel
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(15, 6, 'Nomor', 1, 0);
        $this->Cell(25, 6, 'Nik', 1, 0);
        $this->Cell(53, 6, 'Nama Peserta', 1, 0);
        $this->Cell(10, 6, 'Nilai', 1, 0);
        $this->Cell(25, 6, 'Jenis Tes', 1, 1);

        $this->SetFont('helvetica', '', 10);

        // koneksi ke database
        include '../../config/db.php';
        if (mysqli_connect_errno()) {
            die("Failed to connect to MySQL: " . mysqli_connect_error());
        }

        $no = 1;
        $tampil = mysqli_query($con, "SELECT nama, nik, nilai, jenistes FROM data_pribadi INNER JOIN datanilai ON data_pribadi.nik = datanilai.nik_dn WHERE jenistes='$gh'");
        while ($hasil = $tampil->fetch_assoc()) {
            $this->Cell(15, 6, $no++, 1, 0);
            $this->Cell(25, 6, $hasil['nik'], 1, 0);
            $this->Cell(53, 6, $hasil['nama'], 1, 0);
            $this->Cell(10, 6, $hasil['nilai'], 1, 0);
            $this->Cell(25, 6, $hasil['jenistes'], 1, 1);
        }
    }

    function akhir()
    {
        $this->SetFont('helvetica', 'B', 10);
        $this->Cell(0, 25, 'Direktur RS Maleo', 0, 1, 'R');
        $this->Cell(40);
        $this->Cell(0, 0, 'Dr. Irene S. Dawenan', 0, 1, 'R');
        $this->Cell(0, -10, 'NRP. 20170526001', 0, 1, 'R');
    }
}

// instantisasi objek
$pdf = new pdf();

// Mulai dokumen
$pdf->AddPage('P', 'A5');
// meletakkan gambar
$pdf->letak('../../assets/img/Picture2.png');
// meletakkan judul disamping logo diatas
$pdf->judul('RUMAH SAKIT MALEO', 'JL. Kesehatan No.37, Sorong-98413, Telp. 0951-3122743', 'E-Mail: rumahsakitmaleosorong@yahoo.com');
// membuat garis ganda tebal dan tipis
$pdf->garis();
$pdf->Content();
$pdf->akhir();

$pdf->Output('hasil.pdf', 'I');
?>