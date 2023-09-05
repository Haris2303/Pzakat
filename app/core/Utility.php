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

        $result = null;

        // cek gambar di upload atau tidak
        $result = ($errorFile === 4) ? 0 : $result;

        // cek ekstensi gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        $result = (in_array($ekstensiGambar, $ekstensiGambarValid)) ? $result : 0;

        // cek ukuran gambar > 2mb
        $result = ($ukuran === 2000000) ? 0 : $result;

        // generate nama file baru
        $namaFileWebp = uniqid();
        $namaFileWebp .= '.' . 'webp';

        // convert to webp
        $result = Utility::webpConvert($tmpName) ? $result : false;

        // gambar siap upload
        $path = '/var/www/html/Pzakat/public/img/';
        if (move_uploaded_file($tmpName, $path . $folderName . '/' . $namaFileWebp)) {
            $result = $namaFileWebp;
        } else {
            $result = 0;
        }

        return $result;
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
        return $gram / 1000;
    }

    public static function sendEmail(string $address, string $subject, string $message): bool
    {
        //Load Composer's autoloader
        // require_once LOCALE_URL . '/vendor/autoload.php';

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        $userEmail = 'hrsccf102@gmail.com';

        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = $userEmail;                     //SMTP username
            $mail->Password   = 'fegaucnvcajlshfp';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom($userEmail, 'Lazismu Unamin');
            $mail->addAddress($address);               //Name is optional
            $mail->addReplyTo($userEmail, 'Information');

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = '[Lazismu-Unamin] ' . $subject;
            $mail->Body    = $message;
            $mail->AltBody = 'Donasi Kamu';

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    public static function generateUUID(): string
    {
        if (function_exists('random_bytes')) {
            $data = random_bytes(16);
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $data = openssl_random_pseudo_bytes(16);
        } else {
            $data = uniqid(mt_rand(), true);
        }

        assert(strlen($data) == 16);

        // Set version (4) and variant (random)
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // version 4
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // variant: 10

        // Convert to UUID format (8-4-4-4-12)
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    public static function generateToken(): string
    {
        // generate token
        $token = base64_encode(random_bytes(32));
        // delete character '/' and '='
        $token = trim($token, '=');
        $token = explode('/', $token); // delete character '/'
        $token = join('', $token);
        $token = explode('+', $token); // delete character '+'
        return urlencode(join('', $token));
    }
}
