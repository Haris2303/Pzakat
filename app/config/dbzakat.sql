-- phpMyAdmin SQL Dump
-- version 5.2.1deb1+jammy2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 10, 2023 at 09:41 AM
-- Server version: 8.0.34
-- PHP Version: 8.1.2-1ubuntu2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbzakat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `id_user`, `nama`) VALUES
(2, 4, 'Fardhan Arisandi'),
(3, 12, 'Ucup surucup'),
(4, 15, 'Sasuke Susano');

-- --------------------------------------------------------

--
-- Table structure for table `tb_amil`
--

CREATE TABLE `tb_amil` (
  `id_amil` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `id_user` int NOT NULL,
  `id_mesjid` int DEFAULT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_amil`
--

INSERT INTO `tb_amil` (`id_amil`, `UUID`, `id_user`, `id_mesjid`, `nama`, `email`, `nohp`, `alamat`) VALUES
(12, 'aadfadsf341324djfasdjf34132jjiadkfjaidjf', 14, 14, 'Ilham Cool', 'ilham@gmail.com', '08231223233', 'Jalan Kalangan Remaja'),
(21, 'afbb793f-e576-4ce2-a0aa-6cab9849c138', 41, 21, 'Yanto Santoso', 'harisccf102@gmail.com', '09834123', 'Jalna Jlan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id_banner` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `link` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_banner`
--

INSERT INTO `tb_banner` (`id_banner`, `UUID`, `username`, `gambar`, `link`, `datetime`) VALUES
(5, '0395123-adsghewe-39853215-aegfewgeaw', 'ilham', '64c8c63a97f0b.webp', 'http://localhost/Pzakat/program/zakatmaal', '2023-08-01 17:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `tb_donasibarang`
--

CREATE TABLE `tb_donasibarang` (
  `id_donasibarang` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `slug_program` varchar(255) NOT NULL,
  `nama_donatur` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nohp` varchar(13) NOT NULL,
  `pesan` text,
  `jenis_barang` varchar(50) NOT NULL,
  `berat_barang` int NOT NULL,
  `bukti_barang` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_donasibarang`
--

INSERT INTO `tb_donasibarang` (`id_donasibarang`, `UUID`, `slug_program`, `nama_donatur`, `email`, `nohp`, `pesan`, `jenis_barang`, `berat_barang`, `bukti_barang`, `datetime`) VALUES
(2, '', 'donasibarang', 'Yanto', 'yanto@yahoo.com', '082341234', 'asdfasd', 'beras', 500000, '64be5b7f54447.webp', '2023-07-24 20:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `tb_donatur`
--

CREATE TABLE `tb_donatur` (
  `id_donatur` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `id_user` int DEFAULT NULL,
  `id_bank` int DEFAULT NULL,
  `slug_program` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `kode` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_donatur` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `donasi` int NOT NULL,
  `pesan` text NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_donatur`
--

INSERT INTO `tb_donatur` (`id_donatur`, `UUID`, `id_user`, `id_bank`, `slug_program`, `kode`, `nama_donatur`, `email`, `nohp`, `donasi`, `pesan`, `datetime`) VALUES
(2, '', NULL, 15, 'zakatmaal', '464f55841a4da06194ca5bd3a4d5ecb7', 'Fulan', 'haris1230723@gmail.com', '081223231223', 1000000, 'Semoga Berkah', '2023-07-22'),
(3, '', NULL, 15, 'zakatumum', '20255532719aa7c976df91b3f0b19004', 'Guntur', 'haris1230723@gmail.com', '081223231223', 2400000, 'Semoga Berkah', '2023-07-22'),
(5, '', NULL, 19, 'donasipantiasuhan', 'eff0c87162c7bf7f0c638a024896adda', 'Rofiah', 'gqr247andi@gmail.com', '081223231223', 3400000, 'Semoga Berkah', '2023-07-23'),
(6, '', NULL, 20, 'ramadhanberbagi', '8cb1d5478bee5f71e45d0af99f3bb8ee', 'Fulan', 'haris1230723@gmail.com', '082312231223', 500000, 'Semoga Berkah', '2023-07-24'),
(7, '', NULL, 18, 'qurbankambingsegar', 'baef99887680357ffae1699c1bb0b568', 'Fulan', 'haris1230723@gmail.com', '082312231223', 300000, 'Semoga Berkah', '2023-07-24'),
(11, '', 16, 14, 'infaqpembangunan', '8ffaaa3390f3f769f02bf79f89284b6a', 'Fulan', 'haris1230723@gmail.com', '082312323123', 700000, 'Semoga Berkah', '2023-07-28'),
(16, '', NULL, 14, 'infaqikhlas', '26c180cead95b1867ece4028d4d6172d', 'Asdfads', 'haris1230723@gmail.com', '082312231223', 50000, 'Semoga Berkah', '2023-07-28'),
(17, '', 16, 14, 'infaqikhlas', 'KDA-64c5d38f6eac7_1690686351', 'Hamsa', 'haris1230723@gmail.com', '081232322323', 200000, 'Semoga Berkah', '2023-07-30'),
(18, '', 16, 15, 'zakatpenghasilan', 'KDA-64c5e76fc4b96_1690691439', 'Zaki', 'haris1230723@gmail.com', '082341234', 150000, 'Semoga Berkah', '2023-07-30'),
(27, '', NULL, 15, 'zakatmaal', 'KDA-64c6397e0e92d_1690712446', 'Garo', 'harisccf102@gmail.com', '082312323123', 30000, 'Semoga Berkah', '2023-07-30'),
(29, '', 16, 15, 'zakatpenghasilan', 'KDA-64c7219dee06c_1690771869', 'Fulan', 'harisccf102@gmail.com', '082312323123', 70000, 'Semoga Berkah', '2023-07-31'),
(34, '', 16, 15, 'zakatumum', 'KDA-64c7238dd0e11_1690772365', 'Fulana', 'harisccf102@gmail.com', '082312323123', 230000, 'Semoga Berkah', '2023-07-31'),
(37, '', 16, 15, 'zakatpenghasilan', 'KDA-64cb1654584eb_1691031124', 'Samsudin Jalamaludin', 'haris1230723@gmail.com', '082312321223', 3000000, 'Semoga Berkah ', '2023-08-03'),
(50, '', 16, 14, 'infaqikhlas', 'KDA-64cc80cc26b3d_1691123916', 'Hamba Allah', 'haris1230723@gmail.com', '082312321223', 2000000, 'Semoga Berkah', '2023-08-04'),
(52, '', NULL, 14, 'infaqumum', 'KDA-64ced674f3fd6_1691276916', 'Bambang', 'haris1230723@gmail.com', '08321223333', 50000, 'Semoga Berkah', '2023-08-06'),
(53, '', NULL, 14, 'infaqikhlas', 'KDA-64cf817d4bcfb_1691320701', 'Abdul', 'harisccf102@gmail.com', '082312321223', 500000, 'Semoga Berkah', '2023-08-06'),
(54, '', NULL, 14, 'infaqikhlas', 'KDA-64cf81c87b168_1691320776', 'Abdul', 'harisccf102@gmail.com', '08231234343', 500000, 'Semoga Berkah', '2023-08-06');

--
-- Triggers `tb_donatur`
--
DELIMITER $$
CREATE TRIGGER `donaturTransaksi` AFTER INSERT ON `tb_donatur` FOR EACH ROW INSERT INTO tb_pembayaran VALUES(NULL, NEW.id_donatur, NEW.id_user, NULL, NEW.kode, 'uang', NEW.donasi, '', NOW(), 'pending')
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategoriprogram`
--

CREATE TABLE `tb_kategoriprogram` (
  `id_kategoriprogram` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `nama_kategoriprogram` varchar(20) NOT NULL,
  `status` enum('aktif','pasif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kategoriprogram`
--

INSERT INTO `tb_kategoriprogram` (`id_kategoriprogram`, `UUID`, `nama_kategoriprogram`, `status`) VALUES
(1, '', 'Zakat', 'aktif'),
(2, '', 'Infaq', 'aktif'),
(3, '', 'Donasi', 'aktif'),
(4, '', 'Qurban', 'pasif'),
(5, '', 'Ramadhan', 'pasif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan`
--

CREATE TABLE `tb_laporan` (
  `id_laporan` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `link` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `tahun` year NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_laporan`
--

INSERT INTO `tb_laporan` (`id_laporan`, `UUID`, `link`, `keterangan`, `tahun`, `created_at`) VALUES
(1, 'adsfadsadf-353523532-adsfkjfinvei-351325', 'https://etheses.uinsgd.ac.id/35103/1/0-HO%20Penulisan%20Makalah%20Mahasiswa.pdf', 'Laporan tahun ini bisa anda lihat di link berikut ini', '2023', '2023-08-07 08:49:39'),
(4, '481d52f3-5fba-4d5e-a956-d50d6a395178', 'https://google.com/', 'Laporan wkwkwkwkwkw', '2065', '2023-08-07 08:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_latarbelakang`
--

CREATE TABLE `tb_latarbelakang` (
  `id_latarbelakang` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_latarbelakang`
--

INSERT INTO `tb_latarbelakang` (`id_latarbelakang`, `username`, `content`, `datetime`) VALUES
(1, 'Sutoyo', '<div class=\"flex flex-grow flex-col gap-3\">\r\n<div class=\"min-h-[20px] flex flex-col items-start gap-4 whitespace-pre-wrap break-words\">\r\n<div class=\"markdown prose w-full break-words dark:prose-invert light\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Aplikasi zakat merupakan sebuah aplikasi yang dirancang untuk memfasilitasi proses pengumpulan, pengelolaan, dan distribusi zakat. Latar belakang dari aplikasi zakat berkaitan dengan tujuan untuk mempermudah dan mempercepat proses zakat, serta meningkatkan efisiensi, transparansi, dan akurasi dalam pengelolaan dana zakat.</span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Berikut adalah beberapa latar belakang penting dari aplikasi lazismu unamin:</span></p>\r\n<ol style=\"list-style: initial; margin-left: 20px;\">\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Kemudahan dan Keterjangkauan: Aplikasi zakat memberikan kemudahan bagi masyarakat untuk melakukan pembayaran zakat secara online, tanpa harus datang ke lembaga zakat secara fisik. Ini memudahkan individu atau organisasi untuk membayar zakat dengan cepat dan nyaman, menggunakan berbagai metode pembayaran yang tersedia.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Transparansi: Aplikasi zakat dapat memberikan tingkat transparansi yang lebih tinggi dalam pengelolaan dana zakat. Masyarakat dapat melihat secara jelas bagaimana dana zakat mereka digunakan dan didistribusikan. Informasi mengenai jumlah yang terkumpul, program yang didukung, dan bantuan yang diberikan dapat diakses dengan mudah melalui aplikasi.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Akurasi dan Rekam Jejak: Dengan menggunakan aplikasi zakat, data mengenai penerima dan penggunaan dana zakat dapat direkam dengan akurat. Aplikasi dapat mencatat setiap transaksi zakat, menyimpan data historis, dan menghasilkan laporan yang berguna untuk audit dan evaluasi.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Efisiensi dan Skalabilitas: Aplikasi zakat memungkinkan lembaga zakat untuk mengelola dana dengan lebih efisien. Proses administratif seperti verifikasi data penerima, pengolahan pembayaran, dan penyaluran dana dapat dipercepat dan diotomatisasi melalui aplikasi. Aplikasi juga dapat mempermudah manajemen dana zakat yang besar dan memungkinkan skala operasional yang lebih besar.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Peningkatan Partisipasi: Aplikasi zakat dapat meningkatkan partisipasi masyarakat dalam membayar zakat. Dengan kemudahan akses dan transparansi yang diberikan oleh aplikasi, diharapkan lebih banyak orang yang termotivasi untuk melaksanakan kewajiban zakat mereka.</span></p>\r\n</li>\r\n</ol>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Dalam keseluruhan, aplikasi zakat bertujuan untuk mengoptimalkan pengelolaan zakat, meningkatkan partisipasi masyarakat, dan memperkuat kepercayaan masyarakat terhadap lembaga zakat melalui penerapan teknologi informasi yang canggih.</span></p>\r\n</div>\r\n</div>\r\n</div>', '2023-06-12 09:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mesjid`
--

CREATE TABLE `tb_mesjid` (
  `id_mesjid` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `nama_mesjid` varchar(50) NOT NULL,
  `alamat_mesjid` varchar(255) NOT NULL,
  `RT` varchar(3) NOT NULL,
  `RW` varchar(3) NOT NULL,
  `provinsi` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kelurahan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_mesjid`
--

INSERT INTO `tb_mesjid` (`id_mesjid`, `UUID`, `nama_mesjid`, `alamat_mesjid`, `RT`, `RW`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`) VALUES
(14, '8695c792-2bb1-4bce-8d03-0abb71c8e657', 'Al Wathan', 'Jalan Danau Tigi,  Komplek Buton', '002', '002', 'PAPUA BARAT', 'KOTA SORONG', 'SORONG BARAT', 'RUFEI'),
(21, '42b8140f-cba1-4a99-8fbd-ab49701a05b8', 'adsfasdf', 'asdfdsf', '222', '222', 'BALI', 'KABUPATEN TABANAN', 'KEDIRI', 'PANGKUNG TIBAH'),
(23, '67f353c4-d197-4d6d-803e-2cd2656f32de', 'adfadfdsf', 'adfadsfadsf', '323', '234', 'BALI', 'KABUPATEN KARANG ASEM', 'SELAT', 'MUNCAN');

-- --------------------------------------------------------

--
-- Table structure for table `tb_muzakki`
--

CREATE TABLE `tb_muzakki` (
  `id_muzakki` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_muzakki`
--

INSERT INTO `tb_muzakki` (`id_muzakki`, `UUID`, `id_user`, `nama`, `email`, `nohp`) VALUES
(2, '35123543-adsfkanfiwe-3513523-adsfage', 16, 'Fulana bin fulan', 'fulan@gmail.com', '081223002333'),
(15, 'aa9c3526-4acd-4d80-b7ed-f6fa6616a48f', 42, 'Choky choky', 'harisaja2303@gmail.com', '0834123512');

-- --------------------------------------------------------

--
-- Table structure for table `tb_norek`
--

CREATE TABLE `tb_norek` (
  `id_norek` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `norek` varchar(20) NOT NULL,
  `jenis_program` varchar(50) NOT NULL,
  `saldo_donasi` bigint NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_norek`
--

INSERT INTO `tb_norek` (`id_norek`, `UUID`, `nama_pemilik`, `nama_bank`, `norek`, `jenis_program`, `saldo_donasi`, `gambar`) VALUES
(14, 'adfadfadsf-3432423s-adsfadsf-3423143', 'Salahudin', 'BANK BCA', '513413411', 'Infaq', 6200000, 'bank-bca.jpeg'),
(15, 'adfadfeve-357123-kdfngae-351235', 'Jalaludin Syukurudin', 'BANK BRI', '132412351233', 'Zakat', 10198000, 'bank-bri.jpeg'),
(16, '32312-adsfkje-beigq-3512357df', 'Sotoyo Maryo', 'BANK MUAMALAT', '123423410999', 'Zakat', 653000, 'bank-muamalat.jpeg'),
(18, '35843025-adfdafv-35185a-adfege', 'Udin', 'BANK BNI', '12223412413445', 'Qurban', 4200000, 'bank-bni.jpeg'),
(19, 'dfkajdie-375132895-adfkjafe-3512351', 'Andi Rahmat', 'BANK BNI', '13841320943122', 'Donasi', 2700000, 'bank-bni.jpeg'),
(20, 'dgegejige-8501958-adkgneo-17348613', 'Suryanto', 'BANK BCA', '3412513134321', 'Ramadhan', 3400000, 'bank-bca.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pemasukkan`
--

CREATE TABLE `tb_pemasukkan` (
  `id_pemasukkan` int NOT NULL,
  `id_pembayaran` int NOT NULL,
  `id_norek` int NOT NULL,
  `pemasukkan_harian` int NOT NULL,
  `pemasukkan_mingguan` int NOT NULL,
  `pemasukkan_bulanan` int NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_donatur` int NOT NULL,
  `id_user` int DEFAULT NULL,
  `username_amil` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nomor_pembayaran` varchar(100) NOT NULL,
  `jenis_pembayaran` varchar(100) NOT NULL,
  `jumlah_pembayaran` int NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `status_pembayaran` enum('failed','pending','konfirmasi','success') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_donatur`, `id_user`, `username_amil`, `nomor_pembayaran`, `jenis_pembayaran`, `jumlah_pembayaran`, `bukti_pembayaran`, `tanggal_pembayaran`, `status_pembayaran`) VALUES
(2, 2, 0, 'ilham', 'KDA-1689993948', 'uang', 1000000, '64bb42e5cf77a.webp', '2023-07-22 11:45:57', 'success'),
(3, 3, 0, 'ilham', 'KDA-1689994084', 'uang', 2400000, '64bb436eaebda.webp', '2023-07-22 11:48:14', 'success'),
(5, 5, 0, 'ilham', 'KDA-1690093665', 'uang', 3400000, '64bcc868d42be.webp', '2023-07-23 15:27:53', 'success'),
(6, 6, 0, 'ilham', 'KDA-1690173012', 'uang', 500000, '64bdfe5fe0025.webp', '2023-07-24 13:30:23', 'success'),
(7, 7, 0, 'ilham', 'KDA-1690198369', 'uang', 300000, '64be616a395c8.webp', '2023-07-24 20:32:58', 'success'),
(11, 11, 16, 'ilham', 'KDA-1690531073', 'uang', 700000, '64c37a3a89b8e.webp', '2023-07-28 17:20:10', 'success'),
(12, 16, NULL, 'ilham', 'KDA-1690532958', 'uang', 50000, '64c37c666e020.webp', '2023-07-28 17:29:26', 'failed'),
(13, 17, 16, 'ilham', 'KDA-64c5d38f6eac7', 'uang', 200000, '64c5d7fcc75a9.webp', '2023-07-30 12:24:44', 'success'),
(14, 18, 16, 'ilham', 'KDA-64c5e76fc4b96', 'uang', 150000, '64c5e7a322c14.webp', '2023-07-30 13:31:31', 'success'),
(23, 27, NULL, 'ilham', 'KDA-64c6397e0e92d', 'uang', 30000, '64c63b843a20b.webp', '2023-07-30 19:29:24', 'success'),
(25, 29, 16, 'ilham', 'KDA-64c7219dee06c', 'uang', 70000, '64c86834e2b0c.webp', '2023-08-01 11:04:36', 'success'),
(30, 34, 16, 'ilham', 'KDA-64c7238dd0e11', 'uang', 230000, '64c85df3946f6.webp', '2023-08-01 10:20:51', 'success'),
(33, 37, 16, NULL, 'KDA-64cb1654584eb', 'uang', 3000000, '64cb17a3d9509.webp', '2023-08-03 11:57:39', 'success'),
(46, 50, 16, NULL, 'KDA-64cc80cc26b3d', 'uang', 2000000, '64cc8179ddc56.webp', '2023-08-04 13:41:30', 'success'),
(48, 52, NULL, NULL, 'KDA-64ced674f3fd6', 'uang', 50000, '64ced6b8c3f0e.webp', '2023-08-06 08:09:44', 'konfirmasi'),
(49, 53, NULL, NULL, 'KDA-64cf817d4bcfb_1691320701', 'uang', 500000, '', '2023-08-06 20:18:49', 'pending'),
(50, 54, NULL, NULL, 'KDA-64cf81c87b168_1691320776', 'uang', 500000, '', '2023-08-06 20:19:57', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pengeluaran`
--

CREATE TABLE `tb_pengeluaran` (
  `id_pengeluaran` int NOT NULL,
  `id_program` int NOT NULL,
  `id_bank` int DEFAULT NULL,
  `username_amil` varchar(50) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nohp` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis_pengeluaran` varchar(20) NOT NULL,
  `nominal` int NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pengeluaran`
--

INSERT INTO `tb_pengeluaran` (`id_pengeluaran`, `id_program`, `id_bank`, `username_amil`, `nama_penerima`, `alamat`, `nohp`, `jenis_pengeluaran`, `nominal`, `keterangan`, `tanggal`) VALUES
(1, 13, 15, 'ilham', 'Penerima1', 'Jalan Sukun', '08123342233', 'uang', 1000000, 'Membantu fakir miskin', '2023-07-22 11:53:00'),
(2, 9, 15, 'ilham', 'Penerima2', 'Jalan Peras', '08123432343', 'uang', 2000000, 'Membantu fikir miskin', '2023-07-22 11:56:27'),
(3, 24, NULL, 'ilham', 'Penerima1', 'Jalan Sunyi', '082312334234', 'barang', 300000, 'Pengeluaran untuk masjid', '2023-07-24 20:09:09'),
(4, 9, 15, 'ilham', 'Penerima3', 'Jalan Koyok', '082312343243', 'uang', 200000, 'Pengeluaran untuk fakir miskin', '2023-07-24 20:16:22'),
(5, 15, 15, 'ilham', 'Tono', 'Jalan Pusar Tantangan', '08312341234', 'uang', 300000, 'Membutuhkan', '2023-08-07 10:34:52'),
(6, 14, 19, 'ilham', 'Fakir Miskin ', 'Jalan Banyak', '08231232323', 'uang', 1000000, 'Membantu fakir miskin', '2023-08-07 10:37:15');

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id_program` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `nama_program` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `jenis_program` varchar(20) NOT NULL,
  `jenis_pembayaran` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_program` text NOT NULL,
  `nominal_bayar` int DEFAULT NULL,
  `total_dana` int NOT NULL,
  `jumlah_donatur` int NOT NULL,
  `gambar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id_program`, `UUID`, `nama_program`, `slug`, `jenis_program`, `jenis_pembayaran`, `deskripsi_program`, `nominal_bayar`, `total_dana`, `jumlah_donatur`, `gambar`, `content`, `datetime`) VALUES
(6, '', 'Asdfas', 'asdfas', 'Infaq', 'uang', 'asdfas', 0, 0, 0, '647ef34a0593e.webp', '<p>asdfasdf</p>', '2023-06-06 17:50:18'),
(7, '', 'Infaq Umum', 'infaqumum', 'Infaq', 'uang', 'Ayo tunaikan infaq kamu di lazismu-unamin', 0, 0, 0, '647ef609375d7.webp', '<p><span style=\"color: rgb(126, 140, 141);\">Ini adalah content dari infaq umum</span></p>', '2023-06-06 18:02:01'),
(8, '', 'Zakat Fidyah', 'zakatfidyah', 'Zakat', 'fidyah', 'Bayar Hutang Puasa Kamu Dengan Fidyah Untuk Fakir Miskin', 0, 0, 0, '647f0bbabfb7e.webp', '<p><span style=\"color: rgb(52, 73, 94);\">Ini adalah content dari zakat fidyah</span></p>', '2023-06-06 19:34:35'),
(9, '', 'Zakat Umum', 'zakatumum', 'Zakat', 'uang', 'Tunaikan Zakat Umum Kamu Di Lazismu Unamin', 0, 430000, 2, '648021e306588.webp', '<p>ini adalah content</p>', '2023-06-07 15:21:23'),
(10, '', 'Zakat Barang', 'zakatbarang', 'Zakat', 'barang', 'Zakatkan barang anda disini', 0, 0, 0, NULL, NULL, '2023-06-24 12:21:38'),
(11, '', 'Qurban Sapi Gemuk 150kg', 'qurbansapigemuk150kg', 'qurban', 'qurban', 'Tunaikan Qurbanmu Disini Lazismu-unamin', 500000, 0, 0, '64a76b2f2ff31.webp', '<p>Tidak ada content</p>', '2023-07-07 10:32:31'),
(13, '', 'Zakat Maal', 'zakatmaal', 'Zakat', 'uang', 'Tunaikan Zakat Maal Kamu Disini', NULL, 30000, 2, '64bb42bb74e42.webp', '<p>Belum ada content</p>', '2023-07-22 11:45:15'),
(14, '', 'Donasi Panti Asuhan', 'donasipantiasuhan', 'Donasi', 'uang', 'Ayo Donasi Harta Anda Untuk Panti Asuhan Melalui Program Lazismu Unamin', NULL, 2400000, 1, '64bcb5c25cc19.webp', '<p>Tidak ada content</p>', '2023-07-23 14:08:18'),
(15, '', 'Zakat Penghasilan', 'zakatpenghasilan', 'Zakat', 'uang', 'Tunaikan Zakat Penghasilan Disini', NULL, 2920000, 3, '64bcb77696d12.webp', '<p>tidak ada content</p>', '2023-07-23 14:15:34'),
(16, '', 'Infaq Ikhlas', 'infaqikhlas', 'Infaq', 'uang', 'Ikhlaskan Hartamu Pada Program Ini', NULL, 2200000, 2, '64bcb8ac63311.webp', '<p>Tidak ada content</p>', '2023-07-23 14:20:44'),
(17, '', 'Infaq Pembangunan', 'infaqpembangunan', 'Infaq', 'uang', 'Infaq Pembangunan Masjid', NULL, 700000, 1, '64bcb9c75d07a.webp', '<p>tidak ada content</p>', '2023-07-23 14:25:27'),
(18, '', 'Qurban Kambing Segar', 'qurbankambingsegar', 'qurban', 'qurban', 'Qurban Kambing Segar Di Hari Raya Idul Adha', 300000, 300000, 1, '64bcba2e01712.webp', '<p>Tidak ada content</p>', '2023-07-23 14:27:10'),
(21, '', 'Zakat Beras', 'zakatberas', 'Zakat', 'barang', 'Zakat Beras', NULL, 0, 0, NULL, NULL, '2023-07-23 15:05:28'),
(23, '', 'Zakat Emas', 'zakatemas', 'Zakat', 'barang', 'Zakat Emas', NULL, 0, 0, NULL, NULL, '2023-07-23 15:12:50'),
(24, '', 'Donasi Barang', 'donasibarang', 'Donasi', 'barang', 'Donasi Barang', NULL, 200000, 1, NULL, NULL, '2023-07-23 15:22:22'),
(26, '', 'Ramadhan Berbagi', 'ramadhanberbagi', 'Ramadhan', 'uang', 'Berbagi Harga Untuk Orang-orang Berpuasa Agar Dapat Berbuka Bersama', NULL, 500000, 1, '64bdfdeaed463.webp', '<p>Tidak ada content</p>', '2023-07-24 13:28:27');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(60) NOT NULL,
  `waktu_login` datetime NOT NULL,
  `level` enum('1','2','3') NOT NULL,
  `status_aktivasi` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `token`, `waktu_login`, `level`, `status_aktivasi`) VALUES
(4, 'fardhan', '$2y$10$x9PEY77B/BbI3BZVCOvrCeNH/Sg/O1IioYD6KX1T7BPKxrJDYquF2', '', '2023-05-24 21:05:07', '1', '1'),
(12, 'ucup', '$2y$10$YnMo9W1wM.C8P3fQNPG6we74cVURjct6BfGNx6ZXon5XZMU45uCh2', '', '2023-05-25 23:15:44', '1', '1'),
(14, 'ilham', '$2y$10$FZK2q/8HtgUOQ0QZK6rGwuqQZUI0ighH/d9XYASBs4IwAUlXHh/0i', 'tG7zZmaj25shsNkYx0xspTbKpeEhXzIMRYJYdumkNno', '2023-05-28 11:13:23', '2', '1'),
(15, 'superadmin', '$2y$10$DoReLCNA2Zc2ZgzPZzq/quIrTC1JDjvCv0xP81JGoDo4x2BBdU66y', '', '2023-06-01 12:36:18', '1', '1'),
(16, 'fulana', '$2y$10$eu8Lwlvn2eIEg5TfP87esujLqYjUGksQTik604hKlBtM.eTs2HNhm', '', '2023-07-15 15:35:18', '3', '1'),
(41, 'yanto123', '$2y$10$dinGpv6wErYvDQBFFVVL/e4MuHAx8mVquZVfxl1T36j4Up3gnDzeO', 'BBuIat3450Gd2aPxZZqCVJzSeR6cjl1OjuEKRJUf5Q', '2023-08-09 15:04:45', '2', '0'),
(42, 'choky123', '$2y$10$Evn.OkEZd1GTg.Y5Ns1.Fu9UfPcEKSCfnK7bAp7dQvTv3MQVGlR9i', 'Z1IgSkgGxibHLrLSlXERTbQtW8tTLfxYtgdTrZHTfsY', '2023-08-09 15:07:27', '3', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_video`
--

CREATE TABLE `tb_video` (
  `link` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_video`
--

INSERT INTO `tb_video` (`link`, `datetime`) VALUES
('https://www.youtube.com/embed/kebghU-MAuo', '2023-08-07 17:43:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_views`
--

CREATE TABLE `tb_views` (
  `id_views` int NOT NULL,
  `UUID` varchar(60) NOT NULL,
  `nama_penulis` varchar(50) NOT NULL,
  `jenis_views` varchar(25) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_views`
--

INSERT INTO `tb_views` (`id_views`, `UUID`, `nama_penulis`, `jenis_views`, `judul`, `slug`, `gambar`, `content`, `datetime`) VALUES
(1, '', 'admin', 'Berita', 'Ngerinya Kemajuan Teknologi Saat Ini', 'ngerinya-kemajuan-teknologi-saat-ini', '64788d74c6b57.webp', '<p><span style=\"color: rgb(126, 140, 141);\">Perkembangan teknologi saat ini sangat pesat dan terus berkembang dari waktu ke waktu. Teknologi telah mempengaruhi berbagai aspek kehidupan manusia, mulai dari cara berkomunikasi, transportasi, hingga perubahan ruang. Salah satu bidang teknologi yang semakin berkembang adalah teknologi komunikasi. Dalam bidang ini, smartphone dan internet menjadi teknologi yang semakin meningkatkan cara komunikasi manusia<a style=\"color: rgb(126, 140, 141);\" href=\"https://bdkjakarta.kemenag.go.id/berita/pengaruh-kemajuan-teknologi-komunikasi-dan-informasi-terhadap-karakter-anak\" target=\"_blank\" rel=\"noopener noreferrer\">1</a>. Selain itu, teknologi juga mempengaruhi karakter anak-anak. </span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Dalam sebuah artikel yang diterbitkan oleh Balai Diklat Keagamaan Jakarta, teknologi komunikasi dan informasi dapat mempengaruhi karakter anak-anak. Anak-anak yang terlalu sering menggunakan teknologi cenderung menjadi kurang peka terhadap lingkungan sekitar, kurang sabar, dan kurang mampu mengontrol diri<a style=\"color: rgb(126, 140, 141);\" href=\"https://bdkjakarta.kemenag.go.id/berita/pengaruh-kemajuan-teknologi-komunikasi-dan-informasi-terhadap-karakter-anak\" target=\"_blank\" rel=\"noopener noreferrer\">1</a>. Namun, teknologi juga memiliki dampak positif. Salah satu contoh perkembangan teknologi yang sering digunakan sehari-hari adalah kemudahan dalam mengirim pesan atau berkomunikasi dengan orang lain. Teknologi juga memudahkan manusia dalam melakukan pekerjaan sehari-hari, seperti belanja online, membayar tagihan, dan lain sebagainya<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2021/10/15/163032469/contoh-perkembangan-teknologi-yang-sering-digunakan-sehari-hari\" target=\"_blank\" rel=\"noopener noreferrer\">2</a>. Perkembangan teknologi informasi dan komunikasi juga semakin dikenal luas dan menyebar dalam kehidupan manusia. Adanya globalisasi membantu penyebaran perkembangan teknologi ke berbagai negara. Akibatnya, teknologi semakin dikenal luas dan menyebar dalam kehidupan manusia<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2020/12/21/164007469/perkembangan-teknologi-informasi-dan-komunikasi-di-indonesia?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">3</a>. Dalam bidang sosial dan budaya, teknologi juga memiliki dampak yang signifikan. Saat ini, cara berpakaian yang bersifat lebih modern dan bisa menjangkau berbagai kalangan, khususnya anak muda, bisa ditemukan dengan mudah. Hal ini menunjukkan bahwa teknologi juga mempengaruhi budaya dan gaya hidup manusia<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2021/04/09/142234669/dampak-kemajuan-teknologi-di-bidang-sosial-dan-budaya?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">4</a>. Perkembangan teknologi juga mempengaruhi bidang transportasi. </span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Di Indonesia, perkembangan teknologi transportasi sangat dipengaruhi oleh kondisi geografis Indonesia dan pengaruh budaya luar. Saat ini, teknologi transportasi semakin berkembang, seperti adanya transportasi online dan mobil listrik<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2020/12/21/152002869/perkembangan-teknologi-transportasi-di-indonesia?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">5</a>. Perkembangan ilmu dan teknologi juga berpengaruh terhadap perubahan ruang. Dalam bidang arsitektur, teknologi memungkinkan arsitek untuk membuat desain yang lebih canggih dan efisien. Teknologi juga memungkinkan manusia untuk memanfaatkan ruang secara lebih optimal<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2020/06/24/163000969/pengaruh-perkembangan-ilmu-dan-teknologi-terhadap-perubahan-ruang?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">6</a>. Dalam kesimpulannya, perkembangan teknologi saat ini sangat pesat dan terus berkembang dari waktu ke waktu. </span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Teknologi mempengaruhi berbagai aspek kehidupan manusia, baik dampak positif maupun negatif. Oleh karena itu, manusia perlu bijak dalam menggunakan teknologi dan memanfaatkannya sebaik mungkin untuk kepentingan yang positif.</span></p>', '2023-06-01 21:22:12'),
(5, '', 'arya', 'Artikel', 'Kewajiban Seorang Muslim Untuk Berzakat', 'kewajiban-seorang-muslim-untuk-berzakat', '64789015bf47c.webp', '<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat adalah <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">salah satu</span> rukun <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Islam yang</span> wajib <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">ditunaikan bagi setiap</span> muslim yang mampu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dan memiliki kelapangan harta</span>. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Zakat adalah bagian</span> tertentu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dari harta yang wajib</span> dikeluarkan oleh setiap muslim apabila telah mencapai syarat <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">yang ditetapkan</span>. Sebagai <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">salah satu kewajiban umat</span> muslim, zakat memiliki kedudukan yang tinggi dalam Islam. Allah SWT berfirman dalam Surah al-Baqarah: 43, &ldquo;Dirikanlah salat dan bayarkanlah zakat&rdquo;. Berikut adalah beberapa hal yang perlu diketahui tentang kewajiban seorang muslim untuk berzakat:</span></p>\r\n<ol class=\"list-decimal list-outside\" style=\"list-style: initial;\" type=\"1\">\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat merupakan salah satu dari lima rukun Islam yang wajib ditunaikan bagi setiap muslim yang mampu dan memiliki kelapangan harta. Kewajiban zakat ini ditetapkan Allah SWT melalui firmannya dalam Alquran surah Al-Baqarah ayat 43.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat adalah bentuk sedekah kepada umat Islam. Zakat diperlakukan dalam Islam sebagai kewajiban atau seperti pajak. Di dalam rukun Islam, berzakat ada di urutan ketiga, setelah sholat.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat memiliki beberapa jenis, seperti zakat fitrah, zakat mal, zakat penghasilan, dan zakat perdagangan. Setiap jenis zakat memiliki ketentuan dan perhitungannya sendiri.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat fitrah adalah zakat yang diwajibkan atas setiap jiwa baik lelaki dan perempuan muslim yang dilakukan pada bulan Ramadan hingga menjelang salat Idul Fitri. Sementara, zakat mal adalah zakat yang dikeluarkan dari harta kekayaan yang dimiliki oleh seseorang.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat penghasilan atau zakat profesi adalah zakat yang dikeluarkan dari penghasilan yang diperoleh seseorang dari pekerjaannya. Zakat penghasilan diberikan kepada golongan yang berhak menerimanya, seperti fakir miskin, orang yang berhutang, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat perdagangan adalah zakat yang dikeluarkan dari keuntungan yang diperoleh dari perdagangan. Zakat perdagangan diberikan kepada golongan yang berhak menerimanya, seperti fakir miskin, orang yang berhutang, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Tidak menunaikan zakat merupakan dosa besar dalam Islam. Tidak menunaikan zakat dapat mengakibatkan berbagai ancaman dalam kehidupan, seperti kekurangan rezeki, bencana, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat memiliki syarat-syarat yang harus dipenuhi sebelum dikeluarkan, seperti memiliki harta yang cukup atau tidak kekurangan. Dalam pandangan Islam, memberikan hartanya kepada orang lain yang membutuhkan bisa mensucikan jiwa mereka dan juga sebagai pengingat bahwa harta itu bukanlah milik mereka, namun milik Allah SWT yang memberikan harta tersebut.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat memiliki tujuan untuk membuktikan penghambaan diri kepada Allah dan menyucikan harta. Zakat juga memiliki tujuan untuk membantu golongan yang membutuhkan, seperti fakir miskin, orang yang berhutang, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Sebagai seorang muslim, kita harus memahami kewajiban berzakat dan menunaikannya dengan sungguh-sungguh. Kita harus berlomba-lomba dalam kebaikan dan ingatlah selalu nasib saudaramu yang berada dalam kesusahan. Kita harus berusaha untuk selalu menunaikan zakat dengan tepat waktu dan tepat sasaran, sehingga dapat membantu golongan yang membutuhkan dan mendapatkan ridha Allah SWT.</span></li>\r\n</ol>', '2023-06-01 21:33:26'),
(6, '', 'arya', 'Artikel', '​Mengapa Harus Ber​​zakat', '​mengapa-harus-ber​​zakat', '6478900898ba6.webp', '<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Berzakat merupakan kewajiban <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">bagi setiap</span> muslim <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">yang</span> mampu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dan memiliki kelapangan harta</span>. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Berzakat memiliki</span> banyak <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">manfaat dan pentingnya</span> berzakat tidak <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">bisa diabaikan</span>. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Berikut adalah beberapa alasan</span> mengapa harus berzakat:</span></p>\r\n<ol class=\"list-decimal list-outside\" style=\"list-style: initial;\">\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Membantu Golongan yang Membutuhkan<br>Berzakat merupakan bentuk kepedulian terhadap golongan yang membutuhkan. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Zakat diberikan kepada golongan yang berhak menerimanya, seperti fakir miskin, orang yang berhutang, dan lain sebagainya. Dengan berzakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menyucikan Harta<br>Dalam pandangan Islam, harta yang kita miliki bukanlah milik kita sepenuhnya, melainkan milik Allah SWT yang memberikan harta tersebut. Dengan berzakat, kita dapat menyucikan harta yang kita miliki dan membuktikan penghambaan diri kepada Allah SWT.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup mereka dan membantu mereka untuk keluar dari kemiskinan.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kepedulian Sosial<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kepedulian sosial dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Iman<br>Dalam Islam, berzakat merupakan salah satu rukun Islam yang wajib ditunaikan bagi setiap muslim yang mampu dan memiliki kelapangan harta. Dengan menunaikan zakat, kita dapat meningkatkan kualitas iman kita dan membuktikan penghambaan diri kepada Allah SWT.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menghindari Dosa Besar<br>Tidak menunaikan zakat merupakan dosa besar dalam Islam. Tidak menunaikan zakat dapat mengakibatkan berbagai ancaman dalam kehidupan, seperti kekurangan rezeki, bencana, dan lain sebagainya. Oleh karena itu, sebagai seorang muslim, kita harus memahami kewajiban berzakat dan menunaikannya dengan sungguh-sungguh.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menjaga Keseimbangan Sosial<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat menjaga keseimbangan sosial dan mencegah terjadinya ketimpangan sosial.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Solidaritas Umat Muslim<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan solidaritas umat muslim dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Kita Sendiri<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup kita sendiri dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Membantu Membangun Masyarakat yang Lebih Baik<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat membantu membangun masyarakat yang lebih baik dan membantu menciptakan lingkungan yang lebih baik untuk kita semua.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Kehidupan Umat Muslim<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas kehidupan umat muslim dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Keluarga Kita<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup keluarga kita dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Bangsa<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup bangsa dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Manusia Secara Umum<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup manusia secara umum dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup di Dunia dan Akhirat<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas</span></li>\r\n</ol>', '2023-06-01 21:33:12'),
(7, '', 'arya', 'Artikel', 'Hukum Orang Yang Tidak Berzakat', 'hukum-orang-yang-tidak-berzakat', '64789037ad65c.webp', '<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menunaikan zakat merupakan <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">kewajiban bagi</span> setiap muslim <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">yang</span> mampu. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Namun</span>, <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">bagaimana hukum bagi orang yang</span> tidak berzakat <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">pada</span>hal ia mampu? <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Berikut adalah beberapa hal yang</span> perlu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">diketahui tentang hukum orang yang</span> tidak berzakat:</span></p>\r\n<ol class=\"list-decimal list-outside\" style=\"list-style-type: inherit;\">\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\"><span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Zakat adalah</span> kewajiban bagi setiap muslim yang mampu melaksanakannya. Hal ini didasarkan pada dalil-dalil dari kitabullah, sunnah <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Rasulullah</span>, <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dan ijma</span>\' umat Islam.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat padahal ia mampu melaksanakannya, maka ia berdosa dan akan mendapatkan hukuman di akhirat dan di dunia.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Hukuman akhirat yang diterima oleh orang yang tidak berzakat adalah siksa yang pedih, sebagaimana firman-Nya: \"Dan barangsiapa yang menyimpan emas dan perak, dan tidak menafkahkannya pada jalan Allah, maka beritahukanlah kepadanya bahwa dia akan menerima siksa yang pedih.\" (QS. At-Taubah: 34)</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga akan mendapatkan hukuman di dunia, seperti kekurangan rezeki, bencana, dan lain sebagainya.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak mau membayar zakat mendapatkan hukuman yang lebih berat, yaitu kufur. Adapun, hukuman kufur ini berlaku bagi orang yang ingkar terhadap kewajibannya.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga akan kehilangan keberkahan dalam harta yang dimilikinya. Sebaliknya, orang yang menunaikan zakat akan mendapatkan keberkahan dalam harta yang dimilikinya.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Tidak menunaikan zakat juga dapat mengakibatkan terjadinya ketimpangan sosial. Hal ini karena zakat berfungsi sebagai alat untuk mengurangi kesenjangan antara orang yang kaya dan orang yang miskin.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat menyucikan hartanya. Dalam pandangan Islam, harta yang dimiliki bukanlah milik kita sepenuhnya, melainkan milik Allah SWT yang memberikan harta tersebut. Dengan berzakat, kita dapat menyucikan harta yang kita miliki dan membuktikan penghambaan diri kepada Allah SWT.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat membantu golongan yang membutuhkan. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidup orang lain. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup orang lain dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidupnya sendiri. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup kita sendiri dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidup bangsa. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup bangsa dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidup manusia secara umum. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup manusia secara umum dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat membantu membangun masyarakat yang lebih baik. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu membangun masyarakat yang lebih baik dan membantu menciptakan lingkungan yang lebih baik untuk kita semua.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan solidaritas umat muslim. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan solidaritas umat muslim dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n</ol>', '2023-06-01 21:33:59'),
(18, '', 'sartono', 'Artikel', 'Pilar Pendidikan', 'pilar-pendidikan', '64cb1c8dd55c1.webp', '<p><span style=\"color: rgb(52, 73, 94);\">Program pendidikan di Lazismu sebagai peningkatan mutu Sumber Daya Manusia dengan menjalankan berbagai program di bidang pendidikan baik pemenuhan sarana ataupun biaya pendidikan.</span></p>\r\n<p><span style=\"color: rgb(52, 73, 94);\">Selain dalam menjalankan amanat Undang-undang Dasar 1945 untuk berkontribusi dalam mencerdaskan kehidupan bangsa, program pendidikan lazismu untuk terus menghasilkan SDM yang memiliki inovasi dan keilmuan di dalam bidangnya dalam mendukung pembangunan negara.</span></p>\r\n<p><span style=\"color: rgb(52, 73, 94);\">Berikut program yang termasuk dalam bidang pendidikan :</span><br><span style=\"color: rgb(52, 73, 94);\">1. &nbsp; &nbsp; Beasiswa Mentari</span><br><span style=\"color: rgb(52, 73, 94);\">2. &nbsp; &nbsp; Beasiswa Sang Surya</span><br><span style=\"color: rgb(52, 73, 94);\">3. &nbsp; &nbsp; Lazismu Goes To Campus</span><br><span style=\"color: rgb(52, 73, 94);\">4. &nbsp; &nbsp; Peduli Guru</span><br><span style=\"color: rgb(52, 73, 94);\">5. &nbsp; &nbsp; MSPP</span><br><span style=\"color: rgb(52, 73, 94);\">6. &nbsp; &nbsp; Edutab-mu</span><br><span style=\"color: rgb(52, 73, 94);\">7. &nbsp; &nbsp; Save Our School</span></p>', '2023-08-03 12:18:38'),
(19, '', 'ilham', 'Artikel', 'Pilar Kesehatan', 'pilar-kesehatan', '64cb25520c321.webp', '<p><span style=\"color: rgb(52, 73, 94);\">Program kesehatan Lazismu hadir untuk memenuhi hak mustahik dalam mendapatkan hidup yang berkualitas dengan terpenuhinya layanan kesehatan serta protokol kesehatan.</span></p>\r\n<p><span style=\"color: rgb(52, 73, 94);\">Program kesehatan memberikan layanan pencegahan, edukasi, pengobatan, pendampingan kepada mustahik yang membutuhkan. Terutama selama Pandemi Covid-19 menyerang. Lazismu terus melakukan kegiatan kesehatan di seluruh Indonesia.</span></p>\r\n<p><span style=\"color: rgb(52, 73, 94);\">Berikut perincian program kesehatan :</span><br><span style=\"color: rgb(52, 73, 94);\">1. &nbsp; &nbsp; Peduli Kesehatan</span><br><span style=\"color: rgb(52, 73, 94);\">2. &nbsp; &nbsp; Indonesia Mobile Clinic</span><br><span style=\"color: rgb(52, 73, 94);\">3. &nbsp; &nbsp; Rumah Singgah Pasien</span><br><span style=\"color: rgb(52, 73, 94);\">4. &nbsp; &nbsp; ENDTB</span><br><span style=\"color: rgb(52, 73, 94);\">5. &nbsp; &nbsp; TIMBANG</span><br><span style=\"color: rgb(52, 73, 94);\">6. &nbsp; &nbsp; Bebas Covid</span><br><span style=\"color: rgb(52, 73, 94);\">7. &nbsp; &nbsp; SAUM</span></p>', '2023-08-03 12:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `tb_visimisi`
--

CREATE TABLE `tb_visimisi` (
  `id_visimisi` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_visimisi`
--

INSERT INTO `tb_visimisi` (`id_visimisi`, `username`, `content`, `datetime`) VALUES
(2, 'admin', '<div><span style=\"color: rgb(52, 73, 94);\"><strong>Visi</strong></span></div>\r\n<div>&nbsp;</div>\r\n<div><span style=\"color: rgb(52, 73, 94);\">Menjadi agen perubahan yang kuat dalam membantu masyarakat yang membutuhkan dan menciptakan dampak positif dalam mengatasi berbagai tantangan sosial.</span></div>\r\n<div>&nbsp;</div>\r\n<div><span style=\"color: rgb(52, 73, 94);\"><strong>Misi</strong></span></div>\r\n<div>\r\n<ol>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Memberikan bantuan dan dukungan kepada masyarakat yang kurang beruntung, termasuk anak-anak yatim piatu, orang tua lanjut usia, dan orang-orang dengan kebutuhan khusus.</span></li>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Memperjuangkan hak-hak dasar masyarakat seperti pendidikan, kesehatan, dan akses ke air bersih.</span></li>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Menyediakan bantuan darurat dalam situasi krisis seperti bencana alam atau konflik bersenjata.</span></li>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Menggalang dana dan sumber daya untuk mendukung program-program pembangunan berkelanjutan dalam berbagai bidang.</span></li>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Mendorong partisipasi aktif masyarakat dalam kegiatan sosial dan lingkungan untuk menciptakan kesadaran dan kepedulian.</span></li>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Menyediakan akses ke layanan kesehatan yang terjangkau dan berkualitas untuk masyarakat yang kurang mampu.</span></li>\r\n<li style=\"color: rgb(52, 73, 94);\"><span style=\"color: rgb(52, 73, 94);\">Memastikan transparansi dan akuntabilitas dalam pengelolaan dana donasi yang diterima untuk membangun kepercayaan dengan para donatur.</span></li>\r\n</ol>\r\n</div>\r\n<div><span style=\"color: rgb(126, 140, 141);\">Catatan: Visi dan misi donasi dapat bervariasi tergantung pada tujuan dan fokus organisasi atau kampanye donasi tertentu. Contoh di atas hanya merupakan contoh umum untuk memberikan gambaran. Penting untuk menggambarkan visi dan misi secara spesifik dan sesuai dengan tujuan dan nilai-nilai inti organisasi donasi.</span></div>', '2023-08-09 22:39:30');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllAdmin`
-- (See below for the actual view)
--
CREATE TABLE `vwAllAdmin` (
`id_admin` int
,`nama` varchar(50)
,`username` varchar(50)
,`waktu_login` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllAmil`
-- (See below for the actual view)
--
CREATE TABLE `vwAllAmil` (
`id_amil` int
,`UUID` varchar(60)
,`id_mesjid` int
,`nama` varchar(50)
,`email` varchar(100)
,`alamat` varchar(255)
,`nohp` varchar(13)
,`id_user` int
,`token` varchar(60)
,`username` varchar(50)
,`waktu_login` datetime
,`status_aktivasi` enum('0','1')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllArtikel`
-- (See below for the actual view)
--
CREATE TABLE `vwAllArtikel` (
`id_views` int
,`nama_penulis` varchar(50)
,`jenis_views` varchar(25)
,`judul` varchar(255)
,`slug` varchar(255)
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllBerita`
-- (See below for the actual view)
--
CREATE TABLE `vwAllBerita` (
`id_views` int
,`nama_penulis` varchar(50)
,`jenis_views` varchar(25)
,`judul` varchar(255)
,`slug` varchar(255)
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataDonasi`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataDonasi` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataInfaq`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataInfaq` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataPengeluaran`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataPengeluaran` (
`id_pengeluaran` int
,`nama_pemilik` varchar(50)
,`nama_bank` varchar(50)
,`norek` varchar(20)
,`jenis_program` varchar(50)
,`nama_penerima` varchar(50)
,`nama_amil` varchar(50)
,`username_amil` varchar(50)
,`alamat` varchar(255)
,`nohp` varchar(13)
,`jenis_pengeluaran` varchar(20)
,`nominal` int
,`keterangan` text
,`tanggal` datetime
,`nama_program` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataPengeluaranBarang`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataPengeluaranBarang` (
`id_pengeluaran` int
,`nama_program` varchar(100)
,`jenis_program` varchar(20)
,`nama_amil` varchar(50)
,`username_amil` varchar(50)
,`nama_penerima` varchar(50)
,`alamat` varchar(255)
,`nohp` varchar(13)
,`jenis_pengeluaran` varchar(20)
,`nominal` int
,`keterangan` text
,`tanggal` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataPengeluaranTunai`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataPengeluaranTunai` (
`id_pengeluaran` int
,`id_bank` int
,`nama_penerima` varchar(50)
,`username_amil` varchar(50)
,`alamat` varchar(255)
,`jenis_pengeluaran` varchar(20)
,`nominal` int
,`nama_program` varchar(100)
,`keterangan` text
,`tanggal` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataProgramAktif`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataProgramAktif` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`nominal_bayar` int
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
,`id_kategoriprogram` int
,`nama_kategoriprogram` varchar(20)
,`status` enum('aktif','pasif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataQurban`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataQurban` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`nominal_bayar` int
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataRamadhan`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataRamadhan` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllDataZakat`
-- (See below for the actual view)
--
CREATE TABLE `vwAllDataZakat` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllLaporan`
-- (See below for the actual view)
--
CREATE TABLE `vwAllLaporan` (
`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`jumlah_donatur` int
,`pemasukkan` decimal(33,0)
,`pengeluaran` decimal(32,0)
,`total` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllMuzakki`
-- (See below for the actual view)
--
CREATE TABLE `vwAllMuzakki` (
`id_muzakki` int
,`UUID` varchar(60)
,`nama` varchar(50)
,`email` varchar(100)
,`nohp` varchar(13)
,`id_user` int
,`username` varchar(50)
,`waktu_login` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllPembayaran`
-- (See below for the actual view)
--
CREATE TABLE `vwAllPembayaran` (
`id_bank` int
,`slug_program` varchar(255)
,`id_donatur` int
,`id_user` int
,`nama_donatur` varchar(50)
,`email` varchar(100)
,`nohp` varchar(13)
,`pesan` text
,`nama_pemilik` varchar(50)
,`nama_bank` varchar(50)
,`norek` varchar(20)
,`jenis_program` varchar(50)
,`nama_program` varchar(100)
,`jumlah_pembayaran` int
,`nomor_pembayaran` varchar(100)
,`bukti_pembayaran` varchar(100)
,`status_pembayaran` enum('failed','pending','konfirmasi','success')
,`tanggal_pembayaran` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllProgramAktif`
-- (See below for the actual view)
--
CREATE TABLE `vwAllProgramAktif` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
,`id_kategoriprogram` int
,`nama_kategoriprogram` varchar(20)
,`status` enum('aktif','pasif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllProgramAktifTunai`
-- (See below for the actual view)
--
CREATE TABLE `vwAllProgramAktifTunai` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
,`id_kategoriprogram` int
,`nama_kategoriprogram` varchar(20)
,`status` enum('aktif','pasif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllProgramBarangAktif`
-- (See below for the actual view)
--
CREATE TABLE `vwAllProgramBarangAktif` (
`id_program` int
,`nama_program` varchar(100)
,`slug` varchar(255)
,`jenis_program` varchar(20)
,`jenis_pembayaran` varchar(20)
,`deskripsi_program` text
,`total_dana` int
,`jumlah_donatur` int
,`gambar` varchar(100)
,`content` text
,`datetime` datetime
,`id_kategoriprogram` int
,`status` enum('aktif','pasif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllProgramHaveMoney`
-- (See below for the actual view)
--
CREATE TABLE `vwAllProgramHaveMoney` (
`id_program` int
,`nama_program` varchar(100)
,`jenis_program` varchar(20)
,`total_dana` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwLaporanInfaq`
-- (See below for the actual view)
--
CREATE TABLE `vwLaporanInfaq` (
`nama_program` varchar(100)
,`slug` varchar(255)
,`jumlah_donatur` decimal(32,0)
,`pemasukkan` int
,`pengeluaran` decimal(32,0)
,`total` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwLaporanZakat`
-- (See below for the actual view)
--
CREATE TABLE `vwLaporanZakat` (
`nama_program` varchar(100)
,`slug` varchar(255)
,`jumlah_donatur` int
,`pemasukkan` decimal(33,0)
,`pengeluaran` decimal(32,0)
,`total` int
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPemasukkanBulanan`
-- (See below for the actual view)
--
CREATE TABLE `vwPemasukkanBulanan` (
`tahun` int
,`bulan` int
,`total_pemasukkan` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPemasukkanHarian`
-- (See below for the actual view)
--
CREATE TABLE `vwPemasukkanHarian` (
`tanggal_pembayaran` datetime
,`total_pemasukkan` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPembayaranBarang`
-- (See below for the actual view)
--
CREATE TABLE `vwPembayaranBarang` (
`nama_program` varchar(100)
,`jenis_program` varchar(20)
,`id_donasibarang` int
,`slug_program` varchar(255)
,`nama_donatur` varchar(100)
,`email` varchar(100)
,`nohp` varchar(13)
,`pesan` text
,`jenis_barang` varchar(50)
,`berat_barang` int
,`bukti_barang` varchar(100)
,`datetime` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPembayaranGagal`
-- (See below for the actual view)
--
CREATE TABLE `vwPembayaranGagal` (
`id_bank` int
,`id_donatur` int
,`nama_donatur` varchar(50)
,`nama_pemilik` varchar(50)
,`nama_bank` varchar(50)
,`norek` varchar(20)
,`jenis_program` varchar(50)
,`jumlah_pembayaran` int
,`bukti_pembayaran` varchar(100)
,`tanggal_pembayaran` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPembayaranKonfirmasi`
-- (See below for the actual view)
--
CREATE TABLE `vwPembayaranKonfirmasi` (
`id_bank` int
,`id_donatur` int
,`nama_donatur` varchar(50)
,`slug_program` varchar(255)
,`email` varchar(100)
,`nama_pemilik` varchar(50)
,`nama_bank` varchar(50)
,`norek` varchar(20)
,`jenis_program` varchar(50)
,`jumlah_pembayaran` int
,`bukti_pembayaran` varchar(100)
,`status_pembayaran` enum('failed','pending','konfirmasi','success')
,`tanggal_pembayaran` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPembayaranPending`
-- (See below for the actual view)
--
CREATE TABLE `vwPembayaranPending` (
`id_bank` int
,`slug_program` varchar(255)
,`id_donatur` int
,`nama_donatur` varchar(50)
,`email` varchar(100)
,`nohp` varchar(13)
,`pesan` text
,`nama_pemilik` varchar(50)
,`nama_bank` varchar(50)
,`norek` varchar(20)
,`jenis_program` varchar(50)
,`nama_program` varchar(100)
,`jumlah_pembayaran` int
,`nomor_pembayaran` varchar(100)
,`bukti_pembayaran` varchar(100)
,`status_pembayaran` enum('failed','pending','konfirmasi','success')
,`tanggal_pembayaran` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwPembayaranSukses`
-- (See below for the actual view)
--
CREATE TABLE `vwPembayaranSukses` (
`id_bank` int
,`id_donatur` int
,`nama_donatur` varchar(50)
,`nama_pemilik` varchar(50)
,`nama_bank` varchar(50)
,`norek` varchar(20)
,`jenis_program` varchar(50)
,`jumlah_pembayaran` int
,`bukti_pembayaran` varchar(100)
,`tanggal_pembayaran` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwSumProgram`
-- (See below for the actual view)
--
CREATE TABLE `vwSumProgram` (
`jenis_program` varchar(20)
,`total_dana` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwSumProgramInfaq`
-- (See below for the actual view)
--
CREATE TABLE `vwSumProgramInfaq` (
`total_dana` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwSumProgramQurban`
-- (See below for the actual view)
--
CREATE TABLE `vwSumProgramQurban` (
`total_dana` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwSumProgramZakat`
-- (See below for the actual view)
--
CREATE TABLE `vwSumProgramZakat` (
`total_dana` decimal(32,0)
);

-- --------------------------------------------------------

--
-- Structure for view `vwAllAdmin`
--
DROP TABLE IF EXISTS `vwAllAdmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllAdmin`  AS SELECT `tb_admin`.`id_admin` AS `id_admin`, `tb_admin`.`nama` AS `nama`, `tb_user`.`username` AS `username`, `tb_user`.`waktu_login` AS `waktu_login` FROM (`tb_admin` join `tb_user` on((`tb_admin`.`id_user` = `tb_user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllAmil`
--
DROP TABLE IF EXISTS `vwAllAmil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllAmil`  AS SELECT `tb_amil`.`id_amil` AS `id_amil`, `tb_amil`.`UUID` AS `UUID`, `tb_amil`.`id_mesjid` AS `id_mesjid`, `tb_amil`.`nama` AS `nama`, `tb_amil`.`email` AS `email`, `tb_amil`.`alamat` AS `alamat`, `tb_amil`.`nohp` AS `nohp`, `tb_user`.`id_user` AS `id_user`, `tb_user`.`token` AS `token`, `tb_user`.`username` AS `username`, `tb_user`.`waktu_login` AS `waktu_login`, `tb_user`.`status_aktivasi` AS `status_aktivasi` FROM (`tb_amil` join `tb_user` on((`tb_amil`.`id_user` = `tb_user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllArtikel`
--
DROP TABLE IF EXISTS `vwAllArtikel`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllArtikel`  AS SELECT `tb_views`.`id_views` AS `id_views`, `tb_views`.`nama_penulis` AS `nama_penulis`, `tb_views`.`jenis_views` AS `jenis_views`, `tb_views`.`judul` AS `judul`, `tb_views`.`slug` AS `slug`, `tb_views`.`gambar` AS `gambar`, `tb_views`.`content` AS `content`, `tb_views`.`datetime` AS `datetime` FROM `tb_views` WHERE ((`tb_views`.`jenis_views` = 'Artikel') AND (not((`tb_views`.`slug` like '%pilar%')))) ORDER BY `tb_views`.`id_views` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllBerita`
--
DROP TABLE IF EXISTS `vwAllBerita`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllBerita`  AS SELECT `tb_views`.`id_views` AS `id_views`, `tb_views`.`nama_penulis` AS `nama_penulis`, `tb_views`.`jenis_views` AS `jenis_views`, `tb_views`.`judul` AS `judul`, `tb_views`.`slug` AS `slug`, `tb_views`.`gambar` AS `gambar`, `tb_views`.`content` AS `content`, `tb_views`.`datetime` AS `datetime` FROM `tb_views` WHERE ((`tb_views`.`jenis_views` = 'Berita') AND (not((`tb_views`.`slug` like '%pilar%')))) ORDER BY `tb_views`.`id_views` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataDonasi`
--
DROP TABLE IF EXISTS `vwAllDataDonasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataDonasi`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime` FROM `tb_program` WHERE (`tb_program`.`jenis_program` = 'Donasi') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataInfaq`
--
DROP TABLE IF EXISTS `vwAllDataInfaq`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataInfaq`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime` FROM `tb_program` WHERE (`tb_program`.`jenis_program` = 'Infaq') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataPengeluaran`
--
DROP TABLE IF EXISTS `vwAllDataPengeluaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataPengeluaran`  AS SELECT `tb_pengeluaran`.`id_pengeluaran` AS `id_pengeluaran`, `tb_norek`.`nama_pemilik` AS `nama_pemilik`, `tb_norek`.`nama_bank` AS `nama_bank`, `tb_norek`.`norek` AS `norek`, `tb_norek`.`jenis_program` AS `jenis_program`, `tb_pengeluaran`.`nama_penerima` AS `nama_penerima`, `tb_amil`.`nama` AS `nama_amil`, `tb_pengeluaran`.`username_amil` AS `username_amil`, `tb_pengeluaran`.`alamat` AS `alamat`, `tb_pengeluaran`.`nohp` AS `nohp`, `tb_pengeluaran`.`jenis_pengeluaran` AS `jenis_pengeluaran`, `tb_pengeluaran`.`nominal` AS `nominal`, `tb_pengeluaran`.`keterangan` AS `keterangan`, `tb_pengeluaran`.`tanggal` AS `tanggal`, `tb_program`.`nama_program` AS `nama_program` FROM ((((`tb_pengeluaran` join `tb_program` on((`tb_pengeluaran`.`id_program` = `tb_program`.`id_program`))) join `tb_norek` on((`tb_pengeluaran`.`id_bank` = `tb_norek`.`id_norek`))) join `tb_user` on((`tb_pengeluaran`.`username_amil` = `tb_user`.`username`))) join `tb_amil` on((`tb_user`.`id_user` = `tb_amil`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataPengeluaranBarang`
--
DROP TABLE IF EXISTS `vwAllDataPengeluaranBarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataPengeluaranBarang`  AS SELECT `tb_pengeluaran`.`id_pengeluaran` AS `id_pengeluaran`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_amil`.`nama` AS `nama_amil`, `tb_pengeluaran`.`username_amil` AS `username_amil`, `tb_pengeluaran`.`nama_penerima` AS `nama_penerima`, `tb_pengeluaran`.`alamat` AS `alamat`, `tb_pengeluaran`.`nohp` AS `nohp`, `tb_pengeluaran`.`jenis_pengeluaran` AS `jenis_pengeluaran`, `tb_pengeluaran`.`nominal` AS `nominal`, `tb_pengeluaran`.`keterangan` AS `keterangan`, `tb_pengeluaran`.`tanggal` AS `tanggal` FROM (((`tb_pengeluaran` join `tb_program` on((`tb_pengeluaran`.`id_program` = `tb_program`.`id_program`))) join `tb_user` on((`tb_pengeluaran`.`username_amil` = `tb_user`.`username`))) join `tb_amil` on((`tb_user`.`id_user` = `tb_amil`.`id_user`))) WHERE (`tb_pengeluaran`.`jenis_pengeluaran` = 'barang') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataPengeluaranTunai`
--
DROP TABLE IF EXISTS `vwAllDataPengeluaranTunai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataPengeluaranTunai`  AS SELECT `tb_pengeluaran`.`id_pengeluaran` AS `id_pengeluaran`, `tb_pengeluaran`.`id_bank` AS `id_bank`, `tb_pengeluaran`.`nama_penerima` AS `nama_penerima`, `tb_pengeluaran`.`username_amil` AS `username_amil`, `tb_pengeluaran`.`alamat` AS `alamat`, `tb_pengeluaran`.`jenis_pengeluaran` AS `jenis_pengeluaran`, `tb_pengeluaran`.`nominal` AS `nominal`, `tb_program`.`nama_program` AS `nama_program`, `tb_pengeluaran`.`keterangan` AS `keterangan`, `tb_pengeluaran`.`tanggal` AS `tanggal` FROM (`tb_pengeluaran` join `tb_program` on((`tb_pengeluaran`.`id_program` = `tb_program`.`id_program`))) WHERE (`tb_pengeluaran`.`jenis_pengeluaran` = 'uang') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataProgramAktif`
--
DROP TABLE IF EXISTS `vwAllDataProgramAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataProgramAktif`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`nominal_bayar` AS `nominal_bayar`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime`, `tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`, `tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`, `tb_kategoriprogram`.`status` AS `status` FROM (`tb_program` join `tb_kategoriprogram` on((`tb_program`.`jenis_program` = `tb_kategoriprogram`.`nama_kategoriprogram`))) WHERE (`tb_kategoriprogram`.`status` = 'aktif') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataQurban`
--
DROP TABLE IF EXISTS `vwAllDataQurban`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataQurban`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`nominal_bayar` AS `nominal_bayar`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime` FROM `tb_program` WHERE (`tb_program`.`jenis_program` = 'qurban') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataRamadhan`
--
DROP TABLE IF EXISTS `vwAllDataRamadhan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataRamadhan`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime` FROM `tb_program` WHERE (`tb_program`.`jenis_program` = 'Ramadhan') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataZakat`
--
DROP TABLE IF EXISTS `vwAllDataZakat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataZakat`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime` FROM `tb_program` WHERE (`tb_program`.`jenis_program` = 'Zakat') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllLaporan`
--
DROP TABLE IF EXISTS `vwAllLaporan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllLaporan`  AS SELECT `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, (`tb_program`.`total_dana` + sum(`tb_pengeluaran`.`nominal`)) AS `pemasukkan`, sum(`tb_pengeluaran`.`nominal`) AS `pengeluaran`, `tb_program`.`total_dana` AS `total` FROM (`tb_program` join `tb_pengeluaran` on((`tb_program`.`id_program` = `tb_pengeluaran`.`id_program`))) GROUP BY `tb_program`.`nama_program`, `tb_program`.`slug`, `tb_program`.`jumlah_donatur` ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllMuzakki`
--
DROP TABLE IF EXISTS `vwAllMuzakki`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllMuzakki`  AS SELECT `tb_muzakki`.`id_muzakki` AS `id_muzakki`, `tb_muzakki`.`UUID` AS `UUID`, `tb_muzakki`.`nama` AS `nama`, `tb_muzakki`.`email` AS `email`, `tb_muzakki`.`nohp` AS `nohp`, `tb_user`.`id_user` AS `id_user`, `tb_user`.`username` AS `username`, `tb_user`.`waktu_login` AS `waktu_login` FROM (`tb_muzakki` join `tb_user` on((`tb_muzakki`.`id_user` = `tb_user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllPembayaran`
--
DROP TABLE IF EXISTS `vwAllPembayaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllPembayaran`  AS SELECT `tb_donatur`.`id_bank` AS `id_bank`, `tb_donatur`.`slug_program` AS `slug_program`, `tb_donatur`.`id_donatur` AS `id_donatur`, `tb_donatur`.`id_user` AS `id_user`, `tb_donatur`.`nama_donatur` AS `nama_donatur`, `tb_donatur`.`email` AS `email`, `tb_donatur`.`nohp` AS `nohp`, `tb_donatur`.`pesan` AS `pesan`, `tb_norek`.`nama_pemilik` AS `nama_pemilik`, `tb_norek`.`nama_bank` AS `nama_bank`, `tb_norek`.`norek` AS `norek`, `tb_norek`.`jenis_program` AS `jenis_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_pembayaran`.`jumlah_pembayaran` AS `jumlah_pembayaran`, `tb_pembayaran`.`nomor_pembayaran` AS `nomor_pembayaran`, `tb_pembayaran`.`bukti_pembayaran` AS `bukti_pembayaran`, `tb_pembayaran`.`status_pembayaran` AS `status_pembayaran`, `tb_pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran` FROM (((`tb_norek` join `tb_donatur` on((`tb_norek`.`id_norek` = `tb_donatur`.`id_bank`))) join `tb_pembayaran` on((`tb_pembayaran`.`id_donatur` = `tb_donatur`.`id_donatur`))) join `tb_program` on((`tb_donatur`.`slug_program` = `tb_program`.`slug`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramAktif`
--
DROP TABLE IF EXISTS `vwAllProgramAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramAktif`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime`, `tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`, `tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`, `tb_kategoriprogram`.`status` AS `status` FROM (`tb_program` join `tb_kategoriprogram` on((`tb_program`.`jenis_program` = `tb_kategoriprogram`.`nama_kategoriprogram`))) WHERE (`tb_kategoriprogram`.`status` = 'aktif') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramAktifTunai`
--
DROP TABLE IF EXISTS `vwAllProgramAktifTunai`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramAktifTunai`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime`, `tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`, `tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`, `tb_kategoriprogram`.`status` AS `status` FROM (`tb_program` join `tb_kategoriprogram` on((`tb_program`.`jenis_program` = `tb_kategoriprogram`.`nama_kategoriprogram`))) WHERE ((`tb_kategoriprogram`.`status` = 'aktif') AND (`tb_program`.`jenis_pembayaran` <> 'barang')) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramBarangAktif`
--
DROP TABLE IF EXISTS `vwAllProgramBarangAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramBarangAktif`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`, `tb_program`.`deskripsi_program` AS `deskripsi_program`, `tb_program`.`total_dana` AS `total_dana`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, `tb_program`.`gambar` AS `gambar`, `tb_program`.`content` AS `content`, `tb_program`.`datetime` AS `datetime`, `tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`, `tb_kategoriprogram`.`status` AS `status` FROM (`tb_program` join `tb_kategoriprogram` on((`tb_program`.`jenis_program` = `tb_kategoriprogram`.`nama_kategoriprogram`))) WHERE ((`tb_kategoriprogram`.`status` = 'aktif') AND (`tb_program`.`jenis_pembayaran` = 'barang')) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramHaveMoney`
--
DROP TABLE IF EXISTS `vwAllProgramHaveMoney`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramHaveMoney`  AS SELECT `tb_program`.`id_program` AS `id_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_program`.`total_dana` AS `total_dana` FROM `tb_program` WHERE (`tb_program`.`total_dana` > 0) ;

-- --------------------------------------------------------

--
-- Structure for view `vwLaporanInfaq`
--
DROP TABLE IF EXISTS `vwLaporanInfaq`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwLaporanInfaq`  AS SELECT `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, sum(`tb_program`.`jumlah_donatur`) AS `jumlah_donatur`, `tb_program`.`total_dana` AS `pemasukkan`, sum(`tb_pengeluaran`.`nominal`) AS `pengeluaran`, (`tb_program`.`total_dana` - sum(`tb_pengeluaran`.`nominal`)) AS `total` FROM (`tb_program` join `tb_pengeluaran` on((`tb_program`.`id_program` = `tb_pengeluaran`.`id_program`))) WHERE (`tb_program`.`jenis_program` = 'infaq') GROUP BY `tb_program`.`nama_program`, `tb_program`.`slug`, `tb_program`.`jumlah_donatur` ;

-- --------------------------------------------------------

--
-- Structure for view `vwLaporanZakat`
--
DROP TABLE IF EXISTS `vwLaporanZakat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwLaporanZakat`  AS SELECT `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`slug` AS `slug`, `tb_program`.`jumlah_donatur` AS `jumlah_donatur`, (`tb_program`.`total_dana` + sum(`tb_pengeluaran`.`nominal`)) AS `pemasukkan`, sum(`tb_pengeluaran`.`nominal`) AS `pengeluaran`, `tb_program`.`total_dana` AS `total` FROM (`tb_program` join `tb_pengeluaran` on((`tb_program`.`id_program` = `tb_pengeluaran`.`id_program`))) WHERE ((`tb_program`.`jenis_program` = 'Zakat') AND (`tb_program`.`jenis_pembayaran` <> 'barang')) GROUP BY `tb_program`.`nama_program`, `tb_program`.`slug`, `tb_program`.`jumlah_donatur` ;

-- --------------------------------------------------------

--
-- Structure for view `vwPemasukkanBulanan`
--
DROP TABLE IF EXISTS `vwPemasukkanBulanan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPemasukkanBulanan`  AS SELECT year(`tb_pembayaran`.`tanggal_pembayaran`) AS `tahun`, month(`tb_pembayaran`.`tanggal_pembayaran`) AS `bulan`, sum(`tb_pembayaran`.`jumlah_pembayaran`) AS `total_pemasukkan` FROM `tb_pembayaran` WHERE ((`tb_pembayaran`.`status_pembayaran` = 'success') AND (`tb_pembayaran`.`jenis_pembayaran` <> 'barang')) GROUP BY year(`tb_pembayaran`.`tanggal_pembayaran`), month(`tb_pembayaran`.`tanggal_pembayaran`) ORDER BY year(`tb_pembayaran`.`tanggal_pembayaran`) ASC, month(`tb_pembayaran`.`tanggal_pembayaran`) ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vwPemasukkanHarian`
--
DROP TABLE IF EXISTS `vwPemasukkanHarian`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPemasukkanHarian`  AS SELECT `tb_pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran`, sum(`tb_pembayaran`.`jumlah_pembayaran`) AS `total_pemasukkan` FROM `tb_pembayaran` WHERE ((`tb_pembayaran`.`status_pembayaran` = 'success') AND (`tb_pembayaran`.`jenis_pembayaran` <> 'barang')) GROUP BY `tb_pembayaran`.`tanggal_pembayaran` ORDER BY `tb_pembayaran`.`tanggal_pembayaran` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `vwPembayaranBarang`
--
DROP TABLE IF EXISTS `vwPembayaranBarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPembayaranBarang`  AS SELECT `tb_program`.`nama_program` AS `nama_program`, `tb_program`.`jenis_program` AS `jenis_program`, `tb_donasibarang`.`id_donasibarang` AS `id_donasibarang`, `tb_donasibarang`.`slug_program` AS `slug_program`, `tb_donasibarang`.`nama_donatur` AS `nama_donatur`, `tb_donasibarang`.`email` AS `email`, `tb_donasibarang`.`nohp` AS `nohp`, `tb_donasibarang`.`pesan` AS `pesan`, `tb_donasibarang`.`jenis_barang` AS `jenis_barang`, `tb_donasibarang`.`berat_barang` AS `berat_barang`, `tb_donasibarang`.`bukti_barang` AS `bukti_barang`, `tb_donasibarang`.`datetime` AS `datetime` FROM (`tb_donasibarang` join `tb_program` on((`tb_donasibarang`.`slug_program` = `tb_program`.`slug`))) WHERE (`tb_program`.`jenis_pembayaran` = 'barang') ;

-- --------------------------------------------------------

--
-- Structure for view `vwPembayaranGagal`
--
DROP TABLE IF EXISTS `vwPembayaranGagal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPembayaranGagal`  AS SELECT `tb_donatur`.`id_bank` AS `id_bank`, `tb_donatur`.`id_donatur` AS `id_donatur`, `tb_donatur`.`nama_donatur` AS `nama_donatur`, `tb_norek`.`nama_pemilik` AS `nama_pemilik`, `tb_norek`.`nama_bank` AS `nama_bank`, `tb_norek`.`norek` AS `norek`, `tb_norek`.`jenis_program` AS `jenis_program`, `tb_pembayaran`.`jumlah_pembayaran` AS `jumlah_pembayaran`, `tb_pembayaran`.`bukti_pembayaran` AS `bukti_pembayaran`, `tb_pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran` FROM ((`tb_norek` join `tb_donatur` on((`tb_norek`.`id_norek` = `tb_donatur`.`id_bank`))) join `tb_pembayaran` on((`tb_pembayaran`.`id_donatur` = `tb_donatur`.`id_donatur`))) WHERE (`tb_pembayaran`.`status_pembayaran` = 'failed') ;

-- --------------------------------------------------------

--
-- Structure for view `vwPembayaranKonfirmasi`
--
DROP TABLE IF EXISTS `vwPembayaranKonfirmasi`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPembayaranKonfirmasi`  AS SELECT `tb_donatur`.`id_bank` AS `id_bank`, `tb_donatur`.`id_donatur` AS `id_donatur`, `tb_donatur`.`nama_donatur` AS `nama_donatur`, `tb_donatur`.`slug_program` AS `slug_program`, `tb_donatur`.`email` AS `email`, `tb_norek`.`nama_pemilik` AS `nama_pemilik`, `tb_norek`.`nama_bank` AS `nama_bank`, `tb_norek`.`norek` AS `norek`, `tb_norek`.`jenis_program` AS `jenis_program`, `tb_pembayaran`.`jumlah_pembayaran` AS `jumlah_pembayaran`, `tb_pembayaran`.`bukti_pembayaran` AS `bukti_pembayaran`, `tb_pembayaran`.`status_pembayaran` AS `status_pembayaran`, `tb_pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran` FROM ((`tb_norek` join `tb_donatur` on((`tb_norek`.`id_norek` = `tb_donatur`.`id_bank`))) join `tb_pembayaran` on((`tb_pembayaran`.`id_donatur` = `tb_donatur`.`id_donatur`))) WHERE (`tb_pembayaran`.`status_pembayaran` = 'konfirmasi') ;

-- --------------------------------------------------------

--
-- Structure for view `vwPembayaranPending`
--
DROP TABLE IF EXISTS `vwPembayaranPending`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPembayaranPending`  AS SELECT `tb_donatur`.`id_bank` AS `id_bank`, `tb_donatur`.`slug_program` AS `slug_program`, `tb_donatur`.`id_donatur` AS `id_donatur`, `tb_donatur`.`nama_donatur` AS `nama_donatur`, `tb_donatur`.`email` AS `email`, `tb_donatur`.`nohp` AS `nohp`, `tb_donatur`.`pesan` AS `pesan`, `tb_norek`.`nama_pemilik` AS `nama_pemilik`, `tb_norek`.`nama_bank` AS `nama_bank`, `tb_norek`.`norek` AS `norek`, `tb_norek`.`jenis_program` AS `jenis_program`, `tb_program`.`nama_program` AS `nama_program`, `tb_pembayaran`.`jumlah_pembayaran` AS `jumlah_pembayaran`, `tb_pembayaran`.`nomor_pembayaran` AS `nomor_pembayaran`, `tb_pembayaran`.`bukti_pembayaran` AS `bukti_pembayaran`, `tb_pembayaran`.`status_pembayaran` AS `status_pembayaran`, `tb_pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran` FROM (((`tb_norek` join `tb_donatur` on((`tb_norek`.`id_norek` = `tb_donatur`.`id_bank`))) join `tb_pembayaran` on((`tb_pembayaran`.`id_donatur` = `tb_donatur`.`id_donatur`))) join `tb_program` on((`tb_donatur`.`slug_program` = `tb_program`.`slug`))) WHERE (`tb_pembayaran`.`status_pembayaran` = 'pending') ;

-- --------------------------------------------------------

--
-- Structure for view `vwPembayaranSukses`
--
DROP TABLE IF EXISTS `vwPembayaranSukses`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwPembayaranSukses`  AS SELECT `tb_donatur`.`id_bank` AS `id_bank`, `tb_donatur`.`id_donatur` AS `id_donatur`, `tb_donatur`.`nama_donatur` AS `nama_donatur`, `tb_norek`.`nama_pemilik` AS `nama_pemilik`, `tb_norek`.`nama_bank` AS `nama_bank`, `tb_norek`.`norek` AS `norek`, `tb_norek`.`jenis_program` AS `jenis_program`, `tb_pembayaran`.`jumlah_pembayaran` AS `jumlah_pembayaran`, `tb_pembayaran`.`bukti_pembayaran` AS `bukti_pembayaran`, `tb_pembayaran`.`tanggal_pembayaran` AS `tanggal_pembayaran` FROM ((`tb_norek` join `tb_donatur` on((`tb_norek`.`id_norek` = `tb_donatur`.`id_bank`))) join `tb_pembayaran` on((`tb_pembayaran`.`id_donatur` = `tb_donatur`.`id_donatur`))) WHERE (`tb_pembayaran`.`status_pembayaran` = 'success') ;

-- --------------------------------------------------------

--
-- Structure for view `vwSumProgram`
--
DROP TABLE IF EXISTS `vwSumProgram`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwSumProgram`  AS SELECT `tb_program`.`jenis_program` AS `jenis_program`, sum(`tb_program`.`total_dana`) AS `total_dana` FROM `tb_program` WHERE (`tb_program`.`jenis_pembayaran` <> 'barang') GROUP BY `tb_program`.`jenis_program` ;

-- --------------------------------------------------------

--
-- Structure for view `vwSumProgramInfaq`
--
DROP TABLE IF EXISTS `vwSumProgramInfaq`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwSumProgramInfaq`  AS SELECT sum(`tb_program`.`total_dana`) AS `total_dana` FROM `tb_program` WHERE ((`tb_program`.`jenis_program` = 'Infaq') AND (`tb_program`.`jenis_pembayaran` <> 'barang')) ;

-- --------------------------------------------------------

--
-- Structure for view `vwSumProgramQurban`
--
DROP TABLE IF EXISTS `vwSumProgramQurban`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwSumProgramQurban`  AS SELECT sum(`tb_program`.`total_dana`) AS `total_dana` FROM `tb_program` WHERE ((`tb_program`.`jenis_program` = 'Qurban') AND (`tb_program`.`jenis_pembayaran` <> 'barang')) ;

-- --------------------------------------------------------

--
-- Structure for view `vwSumProgramZakat`
--
DROP TABLE IF EXISTS `vwSumProgramZakat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwSumProgramZakat`  AS SELECT sum(`tb_program`.`total_dana`) AS `total_dana` FROM `tb_program` WHERE ((`tb_program`.`jenis_program` = 'Zakat') AND (`tb_program`.`jenis_pembayaran` <> 'barang')) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `INDEX` (`id_user`);

--
-- Indexes for table `tb_amil`
--
ALTER TABLE `tb_amil`
  ADD PRIMARY KEY (`id_amil`),
  ADD UNIQUE KEY `UNIQUE` (`email`,`nohp`),
  ADD UNIQUE KEY `UUID` (`UUID`),
  ADD KEY `INDEX` (`id_user`,`id_mesjid`),
  ADD KEY `id_mesjid` (`id_mesjid`);

--
-- Indexes for table `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `tb_donasibarang`
--
ALTER TABLE `tb_donasibarang`
  ADD PRIMARY KEY (`id_donasibarang`);

--
-- Indexes for table `tb_donatur`
--
ALTER TABLE `tb_donatur`
  ADD PRIMARY KEY (`id_donatur`);

--
-- Indexes for table `tb_kategoriprogram`
--
ALTER TABLE `tb_kategoriprogram`
  ADD PRIMARY KEY (`id_kategoriprogram`),
  ADD UNIQUE KEY `UNIQUE` (`nama_kategoriprogram`);

--
-- Indexes for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD UNIQUE KEY `UNIQUE` (`link`,`tahun`);

--
-- Indexes for table `tb_latarbelakang`
--
ALTER TABLE `tb_latarbelakang`
  ADD PRIMARY KEY (`id_latarbelakang`),
  ADD KEY `INDEX` (`username`);

--
-- Indexes for table `tb_mesjid`
--
ALTER TABLE `tb_mesjid`
  ADD PRIMARY KEY (`id_mesjid`),
  ADD UNIQUE KEY `UNIQUE` (`UUID`);

--
-- Indexes for table `tb_muzakki`
--
ALTER TABLE `tb_muzakki`
  ADD PRIMARY KEY (`id_muzakki`),
  ADD UNIQUE KEY `UNIQUE` (`email`),
  ADD KEY `INDEX` (`id_user`);

--
-- Indexes for table `tb_norek`
--
ALTER TABLE `tb_norek`
  ADD PRIMARY KEY (`id_norek`),
  ADD UNIQUE KEY `UNIQUE` (`norek`);

--
-- Indexes for table `tb_pemasukkan`
--
ALTER TABLE `tb_pemasukkan`
  ADD PRIMARY KEY (`id_pemasukkan`),
  ADD KEY `INDEX` (`id_pembayaran`,`id_norek`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `UNIQUE` (`nomor_pembayaran`),
  ADD KEY `INDEX` (`id_donatur`,`username_amil`);

--
-- Indexes for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `tb_program`
--
ALTER TABLE `tb_program`
  ADD PRIMARY KEY (`id_program`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `UNIQUE` (`username`);

--
-- Indexes for table `tb_video`
--
ALTER TABLE `tb_video`
  ADD PRIMARY KEY (`link`);

--
-- Indexes for table `tb_views`
--
ALTER TABLE `tb_views`
  ADD PRIMARY KEY (`id_views`),
  ADD KEY `INDEX` (`nama_penulis`);

--
-- Indexes for table `tb_visimisi`
--
ALTER TABLE `tb_visimisi`
  ADD PRIMARY KEY (`id_visimisi`),
  ADD KEY `INDEX` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_amil`
--
ALTER TABLE `tb_amil`
  MODIFY `id_amil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id_banner` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_donasibarang`
--
ALTER TABLE `tb_donasibarang`
  MODIFY `id_donasibarang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_donatur`
--
ALTER TABLE `tb_donatur`
  MODIFY `id_donatur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tb_kategoriprogram`
--
ALTER TABLE `tb_kategoriprogram`
  MODIFY `id_kategoriprogram` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_laporan`
--
ALTER TABLE `tb_laporan`
  MODIFY `id_laporan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_latarbelakang`
--
ALTER TABLE `tb_latarbelakang`
  MODIFY `id_latarbelakang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mesjid`
--
ALTER TABLE `tb_mesjid`
  MODIFY `id_mesjid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_muzakki`
--
ALTER TABLE `tb_muzakki`
  MODIFY `id_muzakki` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_norek`
--
ALTER TABLE `tb_norek`
  MODIFY `id_norek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_pemasukkan`
--
ALTER TABLE `tb_pemasukkan`
  MODIFY `id_pemasukkan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tb_pengeluaran`
--
ALTER TABLE `tb_pengeluaran`
  MODIFY `id_pengeluaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id_program` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_views`
--
ALTER TABLE `tb_views`
  MODIFY `id_views` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_visimisi`
--
ALTER TABLE `tb_visimisi`
  MODIFY `id_visimisi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD CONSTRAINT `tb_admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_amil`
--
ALTER TABLE `tb_amil`
  ADD CONSTRAINT `tb_amil_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_amil_ibfk_2` FOREIGN KEY (`id_mesjid`) REFERENCES `tb_mesjid` (`id_mesjid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_muzakki`
--
ALTER TABLE `tb_muzakki`
  ADD CONSTRAINT `tb_muzakki_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_donatur`) REFERENCES `tb_donatur` (`id_donatur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
