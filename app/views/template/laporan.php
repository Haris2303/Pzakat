<?php

//instantisasi objek
$pdf = $data['pdf'];

// init variabel
$nama_program = $data['nama_program'];

// Mulai dokumen
$pdf->AddPage('P', 'A4');
//meletakkan gambar
$pdf->letak(LOCALE_URL . '/report/cetak/img/unamin.jpg');
//meletakkan judul disamping logo diatas
$pdf->judul(strtoupper("PROGRAM $nama_program LAZISMU UNAMIN"), 'DINAS PENDIDIKAN', 'UNIVERSITAS MUHAMMADIYAH SORONG', 'Jambat Balo Pagar Alam
Selatan Kota Pagar Alam Telp. (0730)622442', 'Website: http://sman4pagaralam.sch.id | E-Mail:
smanegeri4pagaralam@gmail.com');
//membuat garis ganda tebal dan tipis
$pdf->garis();
$pdf->content($data['data_content']);
$pdf->akhir();

$pdf->Output(strtolower("laporan_$nama_program"), 'I');
?>