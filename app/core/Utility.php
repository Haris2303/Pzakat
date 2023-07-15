<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Utility
{
    // method upload image 
    public static function uploadImage(array $dataFile, string $folderName)
    {
        // initialisasi file gambar
        $namaFile   = $dataFile['gambar']['name'];
        $ukuran     = $dataFile['gambar']['size'];
        $errorFile  = $dataFile['gambar']['error'];
        $tmpName    = $dataFile['gambar']['tmp_name'];

        // cek gambar di upload atau tidak
        if ($errorFile === 4) return 0;

        // cek ekstensi gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) return 0;

        // cek ukuran gambar > 2mb
        if ($ukuran === 2000000) return 0;

        // generate nama file baru 
        $namaFileWebp = uniqid();
        $namaFileWebp .= '.' . 'webp';

        // convert to webp
        if (!Utility::webpConvert($tmpName)) return false;

        // gambar siap upload
        if (move_uploaded_file($tmpName, '/var/www/html/Pzakat/public/img/' . $folderName . '/' . $namaFileWebp)) return $namaFileWebp;
        else return 0;
    }

    // method convert image to webp
    public static function webpConvert($file, int $compression_quality = 80)
    {
        // check if file exists
        if (!file_exists($file)) {
            return false;
        }
        $file_type = exif_imagetype($file);
        //https://www.php.net/manual/en/function.exif-imagetype.php
        //exif_imagetype($file);
        // 1    IMAGETYPE_GIF
        // 2    IMAGETYPE_JPEG
        // 3    IMAGETYPE_PNG
        // 6    IMAGETYPE_BMP
        // 15   IMAGETYPE_WBMP
        // 16   IMAGETYPE_XBM
        $output_file =  $file . '.webp';
        if (file_exists($output_file)) {
            return $output_file;
        }
        if (function_exists('imagewebp')) {
            switch ($file_type) {
                case '1': //IMAGETYPE_GIF
                    $image = imagecreatefromgif($file);
                    break;
                case '2': //IMAGETYPE_JPEG
                    $image = imagecreatefromjpeg($file);
                    break;
                case '3': //IMAGETYPE_PNG
                    $image = imagecreatefrompng($file);
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                    break;
                case '6': // IMAGETYPE_BMP
                    $image = imagecreatefrombmp($file);
                    break;
                case '15': //IMAGETYPE_Webp
                    return false;
                    break;
                case '16': //IMAGETYPE_XBM
                    $image = imagecreatefromxbm($file);
                    break;
                default:
                    return false;
            }
            // Save the image
            $result = imagewebp($image, $output_file, $compression_quality);
            if (false === $result) {
                return false;
            }
            // Free up memory
            imagedestroy($image);
            return $output_file;
        } elseif (class_exists('Imagick')) {
            $image = new Imagick();
            $image->readImage($file);
            if ($file_type === "3") {
                $image->setImageFormat('webp');
                $image->setImageCompressionQuality($compression_quality);
                $image->setOption('webp:lossless', 'true');
            }
            $image->writeImage($output_file);
            return $output_file;
        }
        return false;
    }

    public static function getKeyRandom(): string
    {
        $length = 16;
        $key = bin2hex(random_bytes($length));

        // setcookie
        setcookie('keyRandom', $key, time() + (24 * 3600));

        return $key;
    }

    public static function convertGramToKilogram(int $gram): float
    {
        $kilogram = $gram / 1000;
        return $kilogram;
    }

    public static function sendEmailKonfirmasi(string $address, string $subject, string $body): bool
    {
        //Load Composer's autoloader
        require '/var/www/html/Pzakat/vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'hrsccf102@gmail.com';                     //SMTP username
            $mail->Password   = 'fegaucnvcajlshfp';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('hrsccf102@gmail.com', 'Lazismu Unamin');
            $mail->addAddress($address);               //Name is optional
            $mail->addReplyTo('hrsccf102@gmail.com', 'Information');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $body;
            $mail->AltBody = 'Donasi Kamu';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    // pesan email body
    public static function mailBody(int $id):string {

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
}
