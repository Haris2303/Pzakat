<?php

class Design {

    // pesan email body
    public static function emailMessageKonfirmasi(int $id):string {

        $controller = new Controller();
        $dataKonfirmasi = $controller->model('Kelolapembayaran_model')->getDataPembayaranById($id);

        // assignment variabel
        $nomor_pembayaran   = $dataKonfirmasi['nomor_pembayaran'];
        $program            = $dataKonfirmasi['nama_program'];
        $nama               = $dataKonfirmasi['nama_donatur'];
        $nominal_donasi     = $dataKonfirmasi['jumlah_pembayaran'];

        return '<!DOCTYPE html>
                <html>
                <head>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 20px;
                        }
                
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #ffffff;
                            border: 1px solid #e4e4e4;
                            padding: 20px;
                            border-radius: 4px;
                        }
                
                        h1 {
                            color: #333333;
                        }
                
                        p {
                            color: #666666;
                        }
                
                        .logo {
                            text-align: center;
                            margin-bottom: 30px;
                        }
                
                        .logo img {
                            max-width: 200px;
                            height: auto;
                        }
                
                        .thank-you {
                            text-align: center;
                            margin-bottom: 30px;
                        }
                
                        .donation-details {
                            margin: 0 auto;
                        }
                
                        .donation-details table {
                            width: 100%;
                        }
                
                        .donation-details table td {
                            padding: 0 10px;
                        }
                
                        .details-label {
                            font-weight: bold;
                        }
                
                        .button {
                            display: inline-block;
                            background-color: #4caf50;
                            color: #ffffff;
                            text-decoration: none;
                            padding: 10px 20px;
                            border-radius: 4px;
                            margin-top: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="thank-you">
                            <h1>Terima Kasih!</h1>
                            <p>Donasi Anda Telah Terkonfirmasi</p>
                        </div>
                        <div class="donation-details">
                            <table border="1px" cellspacing="0">
                                <tr>
                                    <td><p><span class="details-label">Nomor Transaksi</span></p></td>
                                    <td><p>'. $nomor_pembayaran .'</p></td>
                                </tr>
                                <tr>
                                    <td><p><span class="details-label">Nama Donatur</span></p></td>
                                    <td><p>'. $nama .'</p></td>
                                </tr>
                                <tr>
                                    <td><p><span class="details-label">Program</span></p></td>
                                    <td><p>'. $program .'</p></td>
                                </tr>
                                <tr>
                                    <td><p><span class="details-label">Nominal Donasi</span></p></td>
                                    <td><p>Rp '. number_format($nominal_donasi, 0, ',', '.') .'</p></td>
                                </tr>
                            </table>
                        </div>
                        <p>Kami ingin mengucapkan terima kasih atas donasi yang telah Anda berikan. Kontribusi Anda akan membantu kami mencapai tujuan kami dan membuat perbedaan yang signifikan.</p>
                        <p>Jika Anda memiliki pertanyaan lebih lanjut atau ingin mempelajari lebih lanjut tentang bagaimana donasi Anda digunakan, jangan ragu untuk menghubungi kami.</p>
                        <a class="button" href="https://wa.me/6281342528736" target="_blank">Hubungi Kami</a>
                    </div>
                </body>
                </html>';
    }

    // pesan email body
    public static function emailMessageBatal(int $id):string {

        $controller = new Controller();
        $dataKonfirmasi = $controller->model('Kelolapembayaran_model')->getDataPembayaranById($id);

        // assignment variabel
        $program            = $dataKonfirmasi['nama_program'];
        $nama               = $dataKonfirmasi['nama_donatur'];
        $nominal_donasi     = $dataKonfirmasi['jumlah_pembayaran'];

        return '<!DOCTYPE html>
                <html>
                <head>
                    <title>Konfirmasi Pembayaran Gagal</title>
                </head>
                <body>
                    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
                        <h2 style="color: #ff0000; text-align: center;">Konfirmasi Pembayaran Gagal</h2>
                        <p>Dear '. $nama .',</p>
                        <p>Kami menyesal memberitahu Anda bahwa pembayaran sebesar <strong>Rp '. number_format($nominal_donasi, 0, ',', '.') .'</strong> untuk program <strong>'. $program .'</strong> tidak dapat kami terima karena tidak memenuhi syarat pembayaran. Silakan periksa kembali informasi pembayaran yang Anda berikan.</p>
                        <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan lebih lanjut, jangan ragu untuk menghubungi tim kami di nomor atau alamat email berikut:</p>
                        <p>Telepon: 081234567890</p>
                        <p>Email: email@gmail.com</p>
                        <p>Kami harap Anda dapat menyelesaikan pembayaran sesuai syarat yang berlaku agar transaksi Anda dapat kami proses dengan baik.</p>
                        <p>Terima kasih atas perhatian Anda.</p>
                        <p>Salam,<br>
                        Layanan Lazismu-Unamin</p>
                        <hr style="border: none; border-top: 1px solid #ccc; margin-top: 20px;">
                        <p style="text-align: center; font-size: 12px; color: #777;">Email ini adalah email otomatis, mohon jangan membalas email ini.</p>
                    </div>
                </body>
                </html>';
    }

    // pesan summary
    public static function emailMessageSummary(int $id): string {

        $controller = new Controller();
        $data = $controller->model('Kelolapembayaran_model')->getDataPembayaran('pending', 'id_donatur', $id)[0];
        
        $nama = ucwords($data['nama_donatur']);
        $kode = explode('_', $data['nomor_pembayaran'])[0];
        $nominal = number_format($data['jumlah_pembayaran'], 0, ',', '.');
        $nama_program = $data['nama_program'];
        $expired = explode('_', $data['nomor_pembayaran'])[1];
        $tautan = BASEURL . '/transaksi/summary/' . $data['nomor_pembayaran'];

        // Menambahkan 24 jam (24 x 3600 detik) ke timestamp saat ini
        $futureTimestamp = $expired + (24 * 3600);

        // Konversi timestamp 24 jam ke depan ke dalam format tanggal dan waktu
        $futureDateTime = date('Y-m-d H:i', $futureTimestamp);
        
        return '<!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <title>Pembayaran Belum Dibayarkan</title>
                    <style>
                        .button {
                            background-color: #4CAF50;
                            border: none;
                            color: white;
                            padding: 10px 20px;
                            text-align: center;
                            text-decoration: none;
                            display: inline-block;
                            font-size: 16px;
                            margin: 4px 2px;
                            cursor: pointer;
                            border-radius: 4px;
                        }
                    </style>
                </head>
                <body>
                    <div style="max-width: 600px; margin: 0 auto; font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px;">
                        <h1>Pembayaran Belum Dibayarkan</h1>
                        <p>Dear '. $nama .',</p>
                        <p>Kami ingin memberikan pemberitahuan penting mengenai pembayaran yang belum dibayarkan pada akun Anda.</p>
                        
                        <h2>Detail pembayaran yang belum diselesaikan:</h2>
                        <ul>
                            <li>Kode Pembayaran.: '. $kode .'</li>
                            <li>Nama Program : '. $nama_program .'</li>
                            <li>Jumlah Tagihan: Rp '. $nominal .'</li>
                            <li>Tenggat Pembayaran: '. $futureDateTime .'</li>
                        </ul>
                        
                        <p>Kami memahami bahwa kadang-kadang ada kendala atau kelalaian yang dapat terjadi. Untuk menghindari gangguan layanan atau akun yang dinonaktifkan, harap segera melakukan pembayaran sebelum tanggal jatuh tempo yang disebutkan di atas.</p>
                        
                        <p><a class="button" href="'. $tautan .'">Bayar Sekarang</a></p>
                        
                        <p>Jika Anda memerlukan bantuan atau memiliki pertanyaan terkait pembayaran ini, silakan hubungi kami melalui nomor telepon berikut:</p>
                        <p>Nomor Telepon: 08123456890</p>
                        
                        <p>Kami sangat menghargai kerjasama Anda dalam menyelesaikan pembayaran ini dengan segera. Terima kasih atas perhatian dan waktu Anda.</p>
                        <p>Terima kasih atas perhatian Anda.</p>
                        <p>Salam,<br>
                        Layanan Lazismu-Unamin</p>
                        <hr style="border: none; border-top: 1px solid #ccc; margin-top: 20px;">
                        <p style="text-align: center; font-size: 12px; color: #777;">Email ini adalah email otomatis, mohon jangan membalas email ini. Jika Anda memiliki pertanyaan, silakan hubungi Customer Service kami di nomor telepon yang tertera di atas.</p>
                    </div>
                </body>
                </html>
                ';
    }

    public static function blankData(): string {
        return '<div class="flex flex-col justify-center items-center text-lightgray mt-20">
                    <i class="fas fa-solid fa-file text-8xl"></i>
                    <span class="mt-3 text-sm">Data Kosong</span>
                </div>';
    }
}