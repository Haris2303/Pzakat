<?php

class Design {

    /**
     * --------------------------------------------------------------------------------------------------------------------------
     *                  VIEW EMAIL
     * --------------------------------------------------------------------------------------------------------------------------
     */
    private static function emailHeader(): string {
        return '<!DOCTYPE html>
                <html>
                
                <head>
                    <meta charset="UTF-8">
                    <title></title>
                    <style>
                        .container {
                            max-width: 600px;
                            margin: 0 auto;
                            background-color: #1e1e1e;
                            border: 1px solid #e4e4e4;
                            padding: 20px;
                            border-radius: 4px;
                        }
                        h3 {
                            color: #eeeeee;
                        }
                        table {
                            color: #ffffff;
                            font-size: 12px;
                            text-align: left;
                        }
                        p {
                            color: #eeeeee;
                        }
                        p.btn {
                            margin: 2rem 0;
                        }
                        p a {
                            font-size: 14px;
                            border-radius: 0.4rem;
                            color: white;
                            padding: 0.7rem;
                            text-decoration: none;
                            background-color: #4CAF50;
                        }
                    </style>
                </head>
                <body>
                <div class="container">';
    }

    private static function emailFooter(): string {
        return '<p>Salam,<br>
                        Layanan Lazismu-Unamin</p>
                    <hr style="border: none; border-top: 1px solid #ccc;">
                    <p style="text-align: center; font-size: 12px; color: #777;">Email ini adalah email otomatis, mohon jangan
                        membalas email ini. Jika Anda memiliki pertanyaan, silakan hubungi Customer Service kami.</p>
                </div>
                </body>

                </html>';
    }

    // pesan email body
    public static function emailMessageKonfirmasi(int $id):string {

        $controller = new Controller();
        $dataKonfirmasi = $controller->model('Pembayaran_model')->getDataPembayaranById($id);

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
        $dataKonfirmasi = $controller->model('Pembayaran_model')->getDataPembayaranById($id);

        // assignment variabel
        $program            = $dataKonfirmasi['nama_program'];
        $nama               = $dataKonfirmasi['nama_donatur'];
        $nominal_donasi     = $dataKonfirmasi['jumlah_pembayaran'];

        return self::emailHeader() .'
                <h3>Dear '. $nama .',</h3>
                <p>Kami menyesal memberitahu Anda bahwa pembayaran sebesar <strong>Rp '. number_format($nominal_donasi, 0, ',', '.') .'</strong> untuk program <strong>'. $program .'</strong> tidak dapat kami terima karena tidak memenuhi syarat pembayaran. Silakan periksa kembali informasi pembayaran yang Anda berikan.</p>
                <p>Kami harap Anda dapat menyelesaikan pembayaran sesuai syarat yang berlaku agar transaksi Anda dapat kami proses dengan baik.</p>
                <p>Terima kasih atas perhatian Anda.</p>
                '. self::emailFooter();
    }

    // pesan summary
    public static function emailMessageSummary(int $id): string {

        $controller = new Controller();
        $data = $controller->model('Pembayaran_model')->getAllDataPembayaran('pending', [], ['id_donatur =' => $id])[0];
        
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
        
        return self::emailHeader() .'
                <h3>Dear '. $nama .',</h3>
                <p>Kami ingin memberikan pemberitahuan penting mengenai pembayaran yang belum dibayarkan pada akun Anda.</p>
                <p><strong>Detail pembayaran yang belum diselesaikan</strong>:</p>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <th>Kode Pembayaran</th>
                        <td>: '. $kode .'</td>
                    </tr>
                    <tr>
                        <th>Nama Program</th>
                        <td>: '. $nama_program .'</td>
                    </tr>
                    <tr>
                        <th>Jumlah Tagihan</th>
                        <td>: Rp '. $nominal .'</td>
                    </tr>
                    <tr>
                        <th>Tenggat Pembayaran</th>
                        <td>: '. $futureDateTime .'</td>
                    </tr>
                </table>
                <p>Kami memahami bahwa kadang-kadang ada kendala atau kelalaian yang dapat terjadi. Untuk menghindari gangguan
                    layanan atau akun yang dinonaktifkan, harap segera melakukan pembayaran sebelum tanggal jatuh tempo yang
                    disebutkan di atas.</p>
                <p class="btn"><a href="'. $tautan .'">Bayar Sekarang</a></p>
                <p>Kami sangat menghargai kerjasama Anda dalam menyelesaikan pembayaran ini dengan segera. Terima kasih atas
                    perhatian dan waktu Anda.</p>
                
            '. self::emailFooter();
    }

    /**
     * @return string html
     */
    public static function emailMessageForgot(int $user_id, string $email, string $token): string {
        $controller = new Controller();
        $nama = $controller->model('User_model')->getNamaByIdUser($user_id);

        return self::emailHeader().'
                    <h3>Hello, '.$nama.'</h3>
                    <p>Seseorang telah meminta untuk mereset password akun Anda. Jika Anda tidak melakukan permintaan ini, Anda dapat
                        mengabaikan email ini.</p>
                    <p>Jika Anda ingin mereset password Anda, kunjungi halaman reset password kami:</p>
                    <p class="btn"><a href="' . BASEURL . '/login/ubah_password/'.$email.'/'.$token.'">Reset Password</a></p>
                    <p>Terima kasih,</p>
                '.self::emailFooter();
    }

    /**
     * @return string html
     */
    public static function emailMessageActivation(string $username, string $href) {
        return self::emailHeader().'
                <p>Halo '.$username.',</p>
                <p>Terima kasih telah mendaftar di situs kami! Untuk melengkapi proses pendaftaran, silakan mengaktifkan akun Anda dengan mengklik tombol di bawah ini:</p>
                <p class="btn">
                    <a href="'. $href .'">Aktifkan Akun</a>
                </p>
                <p>Setelah akun Anda diaktifkan, Anda akan dapat mengakses layanan kami dan menikmati semua fitur yang disediakan.</p>
                <p>Jika Anda tidak melakukan pendaftaran di situs kami, Anda dapat mengabaikan pesan ini. Akun tersebut tidak akan diaktifkan tanpa tindakan konfirmasi dari Anda.</p>
                <p>Terima kasih atas perhatian dan dukungan Anda.</p>
                '.self::emailFooter();
    }

    /**
     * -------------------------------------------------------------------------------------------------------------------------
     *                  VIEW DATA KOSONG
     * -------------------------------------------------------------------------------------------------------------------------
     */
    public static function blankData(string $message = null) {
        $controller = new Controller();
        $data['msg'] = $message;
        return $controller->view('template/blankdata', $data);
    }

}