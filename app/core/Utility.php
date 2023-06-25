<?php

class Utility
{

    // method upload image 
    public static function uploadImage($dataFile, $folderName)
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
    public static function webpConvert($file, $compression_quality = 80)
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

    public static function convertGramToKilogram($gram): float
    {
        $kilogram = $gram / 1000;
        return $kilogram;
    }
}
