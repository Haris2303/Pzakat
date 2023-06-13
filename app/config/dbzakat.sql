-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2023 at 09:53 PM
-- Server version: 8.0.33-0ubuntu0.20.04.2
-- PHP Version: 7.4.3-4ubuntu2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `id_user` int NOT NULL,
  `id_mesjid` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_amil`
--

INSERT INTO `tb_amil` (`id_amil`, `id_user`, `id_mesjid`, `nama`, `email`, `nohp`, `alamat`) VALUES
(10, 14, 8, 'Ilham Cool', 'ilham@gmail.com', '081232122312', 'Jalan Saja');

-- --------------------------------------------------------

--
-- Table structure for table `tb_banner`
--

CREATE TABLE `tb_banner` (
  `id_banner` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_banner`
--

INSERT INTO `tb_banner` (`id_banner`, `username`, `gambar`, `datetime`) VALUES
(2, 'ilham', '64798ede6b87d.webp', '2023-06-02 15:40:30'),
(3, 'ilham', '64798ee6d578d.webp', '2023-06-02 15:40:39'),
(4, 'ilham', '64798f5de5795.webp', '2023-06-02 15:42:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_donatur`
--

CREATE TABLE `tb_donatur` (
  `id_donatur` int NOT NULL,
  `id_program` int NOT NULL,
  `nama_donatur` varchar(50) NOT NULL,
  `donasi` int NOT NULL,
  `pesan` text NOT NULL,
  `datetime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategoriprogram`
--

CREATE TABLE `tb_kategoriprogram` (
  `id_kategoriprogram` int NOT NULL,
  `nama_kategoriprogram` varchar(20) NOT NULL,
  `status` enum('aktif','pasif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_kategoriprogram`
--

INSERT INTO `tb_kategoriprogram` (`id_kategoriprogram`, `nama_kategoriprogram`, `status`) VALUES
(1, 'Zakat', 'aktif'),
(2, 'Infaq', 'aktif'),
(3, 'Panti Asuhan', 'pasif'),
(4, 'Qurban', 'aktif'),
(5, 'Ramadhan', 'pasif');

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
(1, 'admin', '<div class=\"flex flex-grow flex-col gap-3\">\r\n<div class=\"min-h-[20px] flex flex-col items-start gap-4 whitespace-pre-wrap break-words\">\r\n<div class=\"markdown prose w-full break-words dark:prose-invert light\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Aplikasi zakat merupakan sebuah aplikasi yang dirancang untuk memfasilitasi proses pengumpulan, pengelolaan, dan distribusi zakat. Latar belakang dari aplikasi zakat berkaitan dengan tujuan untuk mempermudah dan mempercepat proses zakat, serta meningkatkan efisiensi, transparansi, dan akurasi dalam pengelolaan dana zakat.</span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Berikut adalah beberapa latar belakang penting dari aplikasi lazismu unamin:</span></p>\r\n<ol style=\"list-style: initial; margin-left: 20px;\">\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Kemudahan dan Keterjangkauan: Aplikasi zakat memberikan kemudahan bagi masyarakat untuk melakukan pembayaran zakat secara online, tanpa harus datang ke lembaga zakat secara fisik. Ini memudahkan individu atau organisasi untuk membayar zakat dengan cepat dan nyaman, menggunakan berbagai metode pembayaran yang tersedia.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Transparansi: Aplikasi zakat dapat memberikan tingkat transparansi yang lebih tinggi dalam pengelolaan dana zakat. Masyarakat dapat melihat secara jelas bagaimana dana zakat mereka digunakan dan didistribusikan. Informasi mengenai jumlah yang terkumpul, program yang didukung, dan bantuan yang diberikan dapat diakses dengan mudah melalui aplikasi.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Akurasi dan Rekam Jejak: Dengan menggunakan aplikasi zakat, data mengenai penerima dan penggunaan dana zakat dapat direkam dengan akurat. Aplikasi dapat mencatat setiap transaksi zakat, menyimpan data historis, dan menghasilkan laporan yang berguna untuk audit dan evaluasi.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Efisiensi dan Skalabilitas: Aplikasi zakat memungkinkan lembaga zakat untuk mengelola dana dengan lebih efisien. Proses administratif seperti verifikasi data penerima, pengolahan pembayaran, dan penyaluran dana dapat dipercepat dan diotomatisasi melalui aplikasi. Aplikasi juga dapat mempermudah manajemen dana zakat yang besar dan memungkinkan skala operasional yang lebih besar.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span style=\"color: rgb(126, 140, 141);\">Peningkatan Partisipasi: Aplikasi zakat dapat meningkatkan partisipasi masyarakat dalam membayar zakat. Dengan kemudahan akses dan transparansi yang diberikan oleh aplikasi, diharapkan lebih banyak orang yang termotivasi untuk melaksanakan kewajiban zakat mereka.</span></p>\r\n</li>\r\n</ol>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Dalam keseluruhan, aplikasi zakat bertujuan untuk mengoptimalkan pengelolaan zakat, meningkatkan partisipasi masyarakat, dan memperkuat kepercayaan masyarakat terhadap lembaga zakat melalui penerapan teknologi informasi yang canggih.</span></p>\r\n</div>\r\n</div>\r\n</div>', '2023-05-25 23:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mesjid`
--

CREATE TABLE `tb_mesjid` (
  `id_mesjid` int NOT NULL,
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

INSERT INTO `tb_mesjid` (`id_mesjid`, `nama_mesjid`, `alamat_mesjid`, `RT`, `RW`, `provinsi`, `kabupaten`, `kecamatan`, `kelurahan`) VALUES
(8, 'Al Wathan', 'Jalan Danau Tigi, Depan kali dekat jembatan', '004', '004', 'PAPUA BARAT', 'KOTA SORONG', 'SORONG BARAT', 'RUFEI'),
(9, 'Al Mujtahidin', 'Jalan Aja gatau saya', '009', '002', 'PAPUA BARAT', 'KOTA SORONG', 'SORONG KOTA', 'KAMPUNG BARU'),
(10, 'Al Fajar', 'Jalan Potong', '012', '002', 'MALUKU', 'KOTA AMBON', 'LEITIMUR SELATAN', 'EMA'),
(11, 'Al Furqan', 'Jalan Muharram', '023', '021', 'BENGKULU', 'KOTA BENGKULU', 'TELUK SEGARA', 'PASAR JITRA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_muzakki`
--

CREATE TABLE `tb_muzakki` (
  `id_muzakki` int NOT NULL,
  `id_user` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_norek`
--

CREATE TABLE `tb_norek` (
  `id_norek` int NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `norek` varchar(20) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_norek`
--

INSERT INTO `tb_norek` (`id_norek`, `nama_pemilik`, `nama_bank`, `norek`, `gambar`) VALUES
(3, 'Ilham Cool', 'Bank Negara Indonesia', '5343112341343', '647886106a421.webp'),
(4, 'Andi Rahmat', 'Mandiri', '532123421233', '6478874ded607.webp'),
(5, 'Ahmad Ilham', 'Bank Papua', '56134113241324', '647890b0d6f99.webp'),
(8, 'Siapa Aja', 'Bank Rakyat Indonesia', '514231234341', '647894b31600c.webp'),
(10, 'Arya Chandra', 'BCA', '151341288888', '64792bc6f3065.webp');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int NOT NULL,
  `id_muzakki` int NOT NULL,
  `id_amil` int DEFAULT NULL,
  `id_bank` int NOT NULL,
  `jumlah_pembayaran` int NOT NULL,
  `bukti_pembayaran` varchar(100) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `status_pembayaran` enum('failed','pending','konfirmasi','success') NOT NULL,
  `nomor_pembayaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_program`
--

CREATE TABLE `tb_program` (
  `id_program` int NOT NULL,
  `nama_program` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `jenis_program` varchar(20) NOT NULL,
  `jenis_pembayaran` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_program` text NOT NULL,
  `total_dana` int NOT NULL,
  `jumlah_donatur` int NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_program`
--

INSERT INTO `tb_program` (`id_program`, `nama_program`, `slug`, `jenis_program`, `jenis_pembayaran`, `deskripsi_program`, `total_dana`, `jumlah_donatur`, `gambar`, `content`, `datetime`) VALUES
(5, 'Zakat Maal', 'ZakatMaal', 'Zakat', 'uang', 'Ayo tunaikan zakat maal kamu di lazismu unamin', 0, 0, '647ddc9ebc17c.webp', '<p>Ini adalah content</p>', '2023-06-05 22:01:19'),
(6, 'Asdfas', 'asdfas', 'Infaq', 'uang', 'asdfas', 0, 0, '647ef34a0593e.webp', '<p>asdfasdf</p>', '2023-06-06 17:50:18'),
(7, 'Infaq Umum', 'infaqumum', 'Infaq', 'uang', 'Ayo tunaikan infaq kamu di lazismu-unamin', 0, 0, '647ef609375d7.webp', '<p><span style=\"color: rgb(126, 140, 141);\">Ini adalah content dari infaq umum</span></p>', '2023-06-06 18:02:01'),
(8, 'Zakat Fidyah', 'zakatfidyah', 'Zakat', 'fidyah', 'Bayar Hutang Puasa Kamu Dengan Fidyah Untuk Fakir Miskin', 0, 0, '647f0bbabfb7e.webp', '<p><span style=\"color: rgb(52, 73, 94);\">Ini adalah content dari zakat fidyah</span></p>', '2023-06-06 19:34:35'),
(9, 'Zakat Umum', 'zakatumum', 'Zakat', 'uang', 'Tunaikan Zakat Umum Kamu Di Lazismu Unamin', 0, 0, '648021e306588.webp', '<p>ini adalah content</p>', '2023-06-07 15:21:23');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `waktu_login` datetime NOT NULL,
  `level` enum('1','2','3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `waktu_login`, `level`) VALUES
(4, 'admin', '$2y$10$W8VP79kDqxCc8Roq42tkl.1ZHq9mNDAZ82e/zAWQidfZFpRMbj8xi', '2023-05-24 21:05:07', '1'),
(12, 'ucup', '$2y$10$YnMo9W1wM.C8P3fQNPG6we74cVURjct6BfGNx6ZXon5XZMU45uCh2', '2023-05-25 23:15:44', '1'),
(14, 'ilham', '$2y$10$IPgkUgLhz7CfF/t.i4tKN.ty5XKbebpfFwW45XykvA5Yn3p35Yp1q', '2023-05-28 11:13:23', '2'),
(15, 'superadmin', '$2y$10$DoReLCNA2Zc2ZgzPZzq/quIrTC1JDjvCv0xP81JGoDo4x2BBdU66y', '2023-06-01 12:36:18', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_views`
--

CREATE TABLE `tb_views` (
  `id_views` int NOT NULL,
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

INSERT INTO `tb_views` (`id_views`, `nama_penulis`, `jenis_views`, `judul`, `slug`, `gambar`, `content`, `datetime`) VALUES
(1, 'admin', 'Berita', 'Ngerinya Kemajuan Teknologi Saat Ini', 'ngerinya-kemajuan-teknologi-saat-ini', '64788d74c6b57.webp', '<p><span style=\"color: rgb(126, 140, 141);\">Perkembangan teknologi saat ini sangat pesat dan terus berkembang dari waktu ke waktu. Teknologi telah mempengaruhi berbagai aspek kehidupan manusia, mulai dari cara berkomunikasi, transportasi, hingga perubahan ruang. Salah satu bidang teknologi yang semakin berkembang adalah teknologi komunikasi. Dalam bidang ini, smartphone dan internet menjadi teknologi yang semakin meningkatkan cara komunikasi manusia<a style=\"color: rgb(126, 140, 141);\" href=\"https://bdkjakarta.kemenag.go.id/berita/pengaruh-kemajuan-teknologi-komunikasi-dan-informasi-terhadap-karakter-anak\" target=\"_blank\" rel=\"noopener noreferrer\">1</a>. Selain itu, teknologi juga mempengaruhi karakter anak-anak. </span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Dalam sebuah artikel yang diterbitkan oleh Balai Diklat Keagamaan Jakarta, teknologi komunikasi dan informasi dapat mempengaruhi karakter anak-anak. Anak-anak yang terlalu sering menggunakan teknologi cenderung menjadi kurang peka terhadap lingkungan sekitar, kurang sabar, dan kurang mampu mengontrol diri<a style=\"color: rgb(126, 140, 141);\" href=\"https://bdkjakarta.kemenag.go.id/berita/pengaruh-kemajuan-teknologi-komunikasi-dan-informasi-terhadap-karakter-anak\" target=\"_blank\" rel=\"noopener noreferrer\">1</a>. Namun, teknologi juga memiliki dampak positif. Salah satu contoh perkembangan teknologi yang sering digunakan sehari-hari adalah kemudahan dalam mengirim pesan atau berkomunikasi dengan orang lain. Teknologi juga memudahkan manusia dalam melakukan pekerjaan sehari-hari, seperti belanja online, membayar tagihan, dan lain sebagainya<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2021/10/15/163032469/contoh-perkembangan-teknologi-yang-sering-digunakan-sehari-hari\" target=\"_blank\" rel=\"noopener noreferrer\">2</a>. Perkembangan teknologi informasi dan komunikasi juga semakin dikenal luas dan menyebar dalam kehidupan manusia. Adanya globalisasi membantu penyebaran perkembangan teknologi ke berbagai negara. Akibatnya, teknologi semakin dikenal luas dan menyebar dalam kehidupan manusia<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2020/12/21/164007469/perkembangan-teknologi-informasi-dan-komunikasi-di-indonesia?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">3</a>. Dalam bidang sosial dan budaya, teknologi juga memiliki dampak yang signifikan. Saat ini, cara berpakaian yang bersifat lebih modern dan bisa menjangkau berbagai kalangan, khususnya anak muda, bisa ditemukan dengan mudah. Hal ini menunjukkan bahwa teknologi juga mempengaruhi budaya dan gaya hidup manusia<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2021/04/09/142234669/dampak-kemajuan-teknologi-di-bidang-sosial-dan-budaya?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">4</a>. Perkembangan teknologi juga mempengaruhi bidang transportasi. </span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Di Indonesia, perkembangan teknologi transportasi sangat dipengaruhi oleh kondisi geografis Indonesia dan pengaruh budaya luar. Saat ini, teknologi transportasi semakin berkembang, seperti adanya transportasi online dan mobil listrik<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2020/12/21/152002869/perkembangan-teknologi-transportasi-di-indonesia?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">5</a>. Perkembangan ilmu dan teknologi juga berpengaruh terhadap perubahan ruang. Dalam bidang arsitektur, teknologi memungkinkan arsitek untuk membuat desain yang lebih canggih dan efisien. Teknologi juga memungkinkan manusia untuk memanfaatkan ruang secara lebih optimal<a style=\"color: rgb(126, 140, 141);\" href=\"https://www.kompas.com/skola/read/2020/06/24/163000969/pengaruh-perkembangan-ilmu-dan-teknologi-terhadap-perubahan-ruang?page=all\" target=\"_blank\" rel=\"noopener noreferrer\">6</a>. Dalam kesimpulannya, perkembangan teknologi saat ini sangat pesat dan terus berkembang dari waktu ke waktu. </span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Teknologi mempengaruhi berbagai aspek kehidupan manusia, baik dampak positif maupun negatif. Oleh karena itu, manusia perlu bijak dalam menggunakan teknologi dan memanfaatkannya sebaik mungkin untuk kepentingan yang positif.</span></p>', '2023-06-01 21:22:12'),
(5, 'arya', 'Artikel', 'Kewajiban Seorang Muslim Untuk Berzakat', 'kewajiban-seorang-muslim-untuk-berzakat', '64789015bf47c.webp', '<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat adalah <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">salah satu</span> rukun <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Islam yang</span> wajib <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">ditunaikan bagi setiap</span> muslim yang mampu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dan memiliki kelapangan harta</span>. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Zakat adalah bagian</span> tertentu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dari harta yang wajib</span> dikeluarkan oleh setiap muslim apabila telah mencapai syarat <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">yang ditetapkan</span>. Sebagai <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">salah satu kewajiban umat</span> muslim, zakat memiliki kedudukan yang tinggi dalam Islam. Allah SWT berfirman dalam Surah al-Baqarah: 43, &ldquo;Dirikanlah salat dan bayarkanlah zakat&rdquo;. Berikut adalah beberapa hal yang perlu diketahui tentang kewajiban seorang muslim untuk berzakat:</span></p>\r\n<ol class=\"list-decimal list-outside\" style=\"list-style: initial;\" type=\"1\">\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat merupakan salah satu dari lima rukun Islam yang wajib ditunaikan bagi setiap muslim yang mampu dan memiliki kelapangan harta. Kewajiban zakat ini ditetapkan Allah SWT melalui firmannya dalam Alquran surah Al-Baqarah ayat 43.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat adalah bentuk sedekah kepada umat Islam. Zakat diperlakukan dalam Islam sebagai kewajiban atau seperti pajak. Di dalam rukun Islam, berzakat ada di urutan ketiga, setelah sholat.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat memiliki beberapa jenis, seperti zakat fitrah, zakat mal, zakat penghasilan, dan zakat perdagangan. Setiap jenis zakat memiliki ketentuan dan perhitungannya sendiri.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat fitrah adalah zakat yang diwajibkan atas setiap jiwa baik lelaki dan perempuan muslim yang dilakukan pada bulan Ramadan hingga menjelang salat Idul Fitri. Sementara, zakat mal adalah zakat yang dikeluarkan dari harta kekayaan yang dimiliki oleh seseorang.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat penghasilan atau zakat profesi adalah zakat yang dikeluarkan dari penghasilan yang diperoleh seseorang dari pekerjaannya. Zakat penghasilan diberikan kepada golongan yang berhak menerimanya, seperti fakir miskin, orang yang berhutang, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat perdagangan adalah zakat yang dikeluarkan dari keuntungan yang diperoleh dari perdagangan. Zakat perdagangan diberikan kepada golongan yang berhak menerimanya, seperti fakir miskin, orang yang berhutang, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Tidak menunaikan zakat merupakan dosa besar dalam Islam. Tidak menunaikan zakat dapat mengakibatkan berbagai ancaman dalam kehidupan, seperti kekurangan rezeki, bencana, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat memiliki syarat-syarat yang harus dipenuhi sebelum dikeluarkan, seperti memiliki harta yang cukup atau tidak kekurangan. Dalam pandangan Islam, memberikan hartanya kepada orang lain yang membutuhkan bisa mensucikan jiwa mereka dan juga sebagai pengingat bahwa harta itu bukanlah milik mereka, namun milik Allah SWT yang memberikan harta tersebut.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Zakat memiliki tujuan untuk membuktikan penghambaan diri kepada Allah dan menyucikan harta. Zakat juga memiliki tujuan untuk membantu golongan yang membutuhkan, seperti fakir miskin, orang yang berhutang, dan lain sebagainya.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Sebagai seorang muslim, kita harus memahami kewajiban berzakat dan menunaikannya dengan sungguh-sungguh. Kita harus berlomba-lomba dalam kebaikan dan ingatlah selalu nasib saudaramu yang berada dalam kesusahan. Kita harus berusaha untuk selalu menunaikan zakat dengan tepat waktu dan tepat sasaran, sehingga dapat membantu golongan yang membutuhkan dan mendapatkan ridha Allah SWT.</span></li>\r\n</ol>', '2023-06-01 21:33:26'),
(6, 'arya', 'Artikel', '​Mengapa Harus Ber​​zakat', '​mengapa-harus-ber​​zakat', '6478900898ba6.webp', '<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Berzakat merupakan kewajiban <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">bagi setiap</span> muslim <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">yang</span> mampu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dan memiliki kelapangan harta</span>. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Berzakat memiliki</span> banyak <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">manfaat dan pentingnya</span> berzakat tidak <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">bisa diabaikan</span>. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Berikut adalah beberapa alasan</span> mengapa harus berzakat:</span></p>\r\n<ol class=\"list-decimal list-outside\" style=\"list-style: initial;\">\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Membantu Golongan yang Membutuhkan<br>Berzakat merupakan bentuk kepedulian terhadap golongan yang membutuhkan. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Zakat diberikan kepada golongan yang berhak menerimanya, seperti fakir miskin, orang yang berhutang, dan lain sebagainya. Dengan berzakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menyucikan Harta<br>Dalam pandangan Islam, harta yang kita miliki bukanlah milik kita sepenuhnya, melainkan milik Allah SWT yang memberikan harta tersebut. Dengan berzakat, kita dapat menyucikan harta yang kita miliki dan membuktikan penghambaan diri kepada Allah SWT.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup mereka dan membantu mereka untuk keluar dari kemiskinan.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kepedulian Sosial<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kepedulian sosial dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Iman<br>Dalam Islam, berzakat merupakan salah satu rukun Islam yang wajib ditunaikan bagi setiap muslim yang mampu dan memiliki kelapangan harta. Dengan menunaikan zakat, kita dapat meningkatkan kualitas iman kita dan membuktikan penghambaan diri kepada Allah SWT.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menghindari Dosa Besar<br>Tidak menunaikan zakat merupakan dosa besar dalam Islam. Tidak menunaikan zakat dapat mengakibatkan berbagai ancaman dalam kehidupan, seperti kekurangan rezeki, bencana, dan lain sebagainya. Oleh karena itu, sebagai seorang muslim, kita harus memahami kewajiban berzakat dan menunaikannya dengan sungguh-sungguh.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menjaga Keseimbangan Sosial<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat menjaga keseimbangan sosial dan mencegah terjadinya ketimpangan sosial.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Solidaritas Umat Muslim<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan solidaritas umat muslim dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Kita Sendiri<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup kita sendiri dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Membantu Membangun Masyarakat yang Lebih Baik<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat membantu membangun masyarakat yang lebih baik dan membantu menciptakan lingkungan yang lebih baik untuk kita semua.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Kehidupan Umat Muslim<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas kehidupan umat muslim dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Keluarga Kita<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup keluarga kita dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Bangsa<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup bangsa dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup Manusia Secara Umum<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas hidup manusia secara umum dan membantu membangun masyarakat yang lebih baik.</span></li>\r\n<li style=\"color: rgb(126, 140, 141);\"><span class=\"\" style=\"color: rgb(126, 140, 141);\">Meningkatkan Kualitas Hidup di Dunia dan Akhirat<br>Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka. Dengan demikian, kita dapat meningkatkan kualitas</span></li>\r\n</ol>', '2023-06-01 21:33:12'),
(7, 'arya', 'Artikel', 'Hukum Orang Yang Tidak Berzakat', 'hukum-orang-yang-tidak-berzakat', '64789037ad65c.webp', '<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Menunaikan zakat merupakan <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">kewajiban bagi</span> setiap muslim <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">yang</span> mampu. <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Namun</span>, <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">bagaimana hukum bagi orang yang</span> tidak berzakat <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">pada</span>hal ia mampu? <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Berikut adalah beberapa hal yang</span> perlu <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">diketahui tentang hukum orang yang</span> tidak berzakat:</span></p>\r\n<ol class=\"list-decimal list-outside\" style=\"list-style-type: inherit;\">\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\"><span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Zakat adalah</span> kewajiban bagi setiap muslim yang mampu melaksanakannya. Hal ini didasarkan pada dalil-dalil dari kitabullah, sunnah <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">Rasulullah</span>, <span class=\"entity-link underline underline-offset-2 decoration-1 transition-all duration-300 cursor-pointer decoration-super md:hover:text-super\">dan ijma</span>\' umat Islam.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat padahal ia mampu melaksanakannya, maka ia berdosa dan akan mendapatkan hukuman di akhirat dan di dunia.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Hukuman akhirat yang diterima oleh orang yang tidak berzakat adalah siksa yang pedih, sebagaimana firman-Nya: \"Dan barangsiapa yang menyimpan emas dan perak, dan tidak menafkahkannya pada jalan Allah, maka beritahukanlah kepadanya bahwa dia akan menerima siksa yang pedih.\" (QS. At-Taubah: 34)</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga akan mendapatkan hukuman di dunia, seperti kekurangan rezeki, bencana, dan lain sebagainya.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak mau membayar zakat mendapatkan hukuman yang lebih berat, yaitu kufur. Adapun, hukuman kufur ini berlaku bagi orang yang ingkar terhadap kewajibannya.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga akan kehilangan keberkahan dalam harta yang dimilikinya. Sebaliknya, orang yang menunaikan zakat akan mendapatkan keberkahan dalam harta yang dimilikinya.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Tidak menunaikan zakat juga dapat mengakibatkan terjadinya ketimpangan sosial. Hal ini karena zakat berfungsi sebagai alat untuk mengurangi kesenjangan antara orang yang kaya dan orang yang miskin.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat menyucikan hartanya. Dalam pandangan Islam, harta yang dimiliki bukanlah milik kita sepenuhnya, melainkan milik Allah SWT yang memberikan harta tersebut. Dengan berzakat, kita dapat menyucikan harta yang kita miliki dan membuktikan penghambaan diri kepada Allah SWT.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat membantu golongan yang membutuhkan. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu golongan yang membutuhkan dan memberikan manfaat bagi mereka.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidup orang lain. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup orang lain dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidupnya sendiri. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup kita sendiri dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidup bangsa. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup bangsa dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan kualitas hidup manusia secara umum. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan kualitas hidup manusia secara umum dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat membantu membangun masyarakat yang lebih baik. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat membantu membangun masyarakat yang lebih baik dan membantu menciptakan lingkungan yang lebih baik untuk kita semua.</span></p>\r\n</li>\r\n<li style=\"color: rgb(126, 140, 141);\">\r\n<p><span class=\"\" style=\"color: rgb(126, 140, 141);\">Orang yang tidak berzakat juga tidak dapat meningkatkan solidaritas umat muslim. Dalam Islam, berzakat diperlakukan sebagai kewajiban atau seperti pajak. Dengan membayar zakat, kita dapat meningkatkan solidaritas umat muslim dan membantu membangun masyarakat yang lebih baik.</span></p>\r\n</li>\r\n</ol>', '2023-06-01 21:33:59');

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
(2, 'admin', '<p><span style=\"color: rgb(126, 140, 141);\"><strong>Visi</strong></span></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Visi adalah visi<br></span></p>\r\n<p><strong><span style=\"color: rgb(126, 140, 141);\">Misi</span></strong></p>\r\n<p><span style=\"color: rgb(126, 140, 141);\">Misi adalah misi<br></span></p>', '2023-05-26 10:13:28');

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
,`id_mesjid` int
,`nama` varchar(50)
,`email` varchar(100)
,`alamat` varchar(255)
,`nohp` varchar(13)
,`id_user` int
,`username` varchar(50)
,`waktu_login` datetime
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
-- Stand-in structure for view `vwAllMuzakki`
-- (See below for the actual view)
--
CREATE TABLE `vwAllMuzakki` (
`id_muzakki` int
,`nama` varchar(50)
,`email` varchar(100)
,`nohp` varchar(13)
,`username` varchar(50)
,`waktu_login` datetime
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
-- Stand-in structure for view `vwAllProgramNameAktif`
-- (See below for the actual view)
--
CREATE TABLE `vwAllProgramNameAktif` (
`id_kategoriprogram` int
,`nama_kategoriprogram` varchar(20)
,`status` enum('aktif','pasif')
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vwAllProgramTidakAktif`
-- (See below for the actual view)
--
CREATE TABLE `vwAllProgramTidakAktif` (
`id_kategoriprogram` int
,`nama_kategoriprogram` varchar(20)
,`status` enum('aktif','pasif')
);

-- --------------------------------------------------------

--
-- Structure for view `vwAllAdmin`
--
DROP TABLE IF EXISTS `vwAllAdmin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllAdmin`  AS  select `tb_admin`.`id_admin` AS `id_admin`,`tb_admin`.`nama` AS `nama`,`tb_user`.`username` AS `username`,`tb_user`.`waktu_login` AS `waktu_login` from (`tb_admin` join `tb_user` on((`tb_admin`.`id_user` = `tb_user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllAmil`
--
DROP TABLE IF EXISTS `vwAllAmil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllAmil`  AS  select `tb_amil`.`id_amil` AS `id_amil`,`tb_amil`.`id_mesjid` AS `id_mesjid`,`tb_amil`.`nama` AS `nama`,`tb_amil`.`email` AS `email`,`tb_amil`.`alamat` AS `alamat`,`tb_amil`.`nohp` AS `nohp`,`tb_user`.`id_user` AS `id_user`,`tb_user`.`username` AS `username`,`tb_user`.`waktu_login` AS `waktu_login` from (`tb_amil` join `tb_user` on((`tb_amil`.`id_user` = `tb_user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataInfaq`
--
DROP TABLE IF EXISTS `vwAllDataInfaq`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataInfaq`  AS  select `tb_program`.`id_program` AS `id_program`,`tb_program`.`nama_program` AS `nama_program`,`tb_program`.`slug` AS `slug`,`tb_program`.`jenis_program` AS `jenis_program`,`tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`,`tb_program`.`deskripsi_program` AS `deskripsi_program`,`tb_program`.`total_dana` AS `total_dana`,`tb_program`.`jumlah_donatur` AS `jumlah_donatur`,`tb_program`.`gambar` AS `gambar`,`tb_program`.`content` AS `content`,`tb_program`.`datetime` AS `datetime` from `tb_program` where (`tb_program`.`jenis_program` = 'Infaq') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataProgramAktif`
--
DROP TABLE IF EXISTS `vwAllDataProgramAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataProgramAktif`  AS  select `tb_program`.`id_program` AS `id_program`,`tb_program`.`nama_program` AS `nama_program`,`tb_program`.`slug` AS `slug`,`tb_program`.`jenis_program` AS `jenis_program`,`tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`,`tb_program`.`deskripsi_program` AS `deskripsi_program`,`tb_program`.`total_dana` AS `total_dana`,`tb_program`.`jumlah_donatur` AS `jumlah_donatur`,`tb_program`.`gambar` AS `gambar`,`tb_program`.`content` AS `content`,`tb_program`.`datetime` AS `datetime`,`tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`,`tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`,`tb_kategoriprogram`.`status` AS `status` from (`tb_program` join `tb_kategoriprogram` on((`tb_program`.`jenis_program` = `tb_kategoriprogram`.`nama_kategoriprogram`))) where (`tb_kategoriprogram`.`status` = 'aktif') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllDataZakat`
--
DROP TABLE IF EXISTS `vwAllDataZakat`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllDataZakat`  AS  select `tb_program`.`id_program` AS `id_program`,`tb_program`.`nama_program` AS `nama_program`,`tb_program`.`slug` AS `slug`,`tb_program`.`jenis_program` AS `jenis_program`,`tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`,`tb_program`.`deskripsi_program` AS `deskripsi_program`,`tb_program`.`total_dana` AS `total_dana`,`tb_program`.`jumlah_donatur` AS `jumlah_donatur`,`tb_program`.`gambar` AS `gambar`,`tb_program`.`content` AS `content`,`tb_program`.`datetime` AS `datetime` from `tb_program` where (`tb_program`.`jenis_program` = 'Zakat') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllMuzakki`
--
DROP TABLE IF EXISTS `vwAllMuzakki`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllMuzakki`  AS  select `tb_muzakki`.`id_muzakki` AS `id_muzakki`,`tb_muzakki`.`nama` AS `nama`,`tb_muzakki`.`email` AS `email`,`tb_muzakki`.`nohp` AS `nohp`,`tb_user`.`username` AS `username`,`tb_user`.`waktu_login` AS `waktu_login` from (`tb_muzakki` join `tb_user` on((`tb_muzakki`.`id_user` = `tb_user`.`id_user`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramAktif`
--
DROP TABLE IF EXISTS `vwAllProgramAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramAktif`  AS  select `tb_program`.`id_program` AS `id_program`,`tb_program`.`nama_program` AS `nama_program`,`tb_program`.`slug` AS `slug`,`tb_program`.`jenis_program` AS `jenis_program`,`tb_program`.`jenis_pembayaran` AS `jenis_pembayaran`,`tb_program`.`deskripsi_program` AS `deskripsi_program`,`tb_program`.`total_dana` AS `total_dana`,`tb_program`.`jumlah_donatur` AS `jumlah_donatur`,`tb_program`.`gambar` AS `gambar`,`tb_program`.`content` AS `content`,`tb_program`.`datetime` AS `datetime`,`tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`,`tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`,`tb_kategoriprogram`.`status` AS `status` from (`tb_program` join `tb_kategoriprogram` on((`tb_program`.`jenis_program` = `tb_kategoriprogram`.`nama_kategoriprogram`))) where (`tb_kategoriprogram`.`status` = 'aktif') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramNameAktif`
--
DROP TABLE IF EXISTS `vwAllProgramNameAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramNameAktif`  AS  select `tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`,`tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`,`tb_kategoriprogram`.`status` AS `status` from `tb_kategoriprogram` where (`tb_kategoriprogram`.`status` = 'aktif') ;

-- --------------------------------------------------------

--
-- Structure for view `vwAllProgramTidakAktif`
--
DROP TABLE IF EXISTS `vwAllProgramTidakAktif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vwAllProgramTidakAktif`  AS  select `tb_kategoriprogram`.`id_kategoriprogram` AS `id_kategoriprogram`,`tb_kategoriprogram`.`nama_kategoriprogram` AS `nama_kategoriprogram`,`tb_kategoriprogram`.`status` AS `status` from `tb_kategoriprogram` where (`tb_kategoriprogram`.`status` = 'pasif') ;

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
  ADD KEY `INDEX` (`id_user`,`id_mesjid`),
  ADD KEY `id_mesjid` (`id_mesjid`);

--
-- Indexes for table `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`id_banner`);

--
-- Indexes for table `tb_donatur`
--
ALTER TABLE `tb_donatur`
  ADD PRIMARY KEY (`id_donatur`),
  ADD KEY `INDEX` (`id_program`);

--
-- Indexes for table `tb_kategoriprogram`
--
ALTER TABLE `tb_kategoriprogram`
  ADD PRIMARY KEY (`id_kategoriprogram`),
  ADD UNIQUE KEY `UNIQUE` (`nama_kategoriprogram`);

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
  ADD PRIMARY KEY (`id_mesjid`);

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
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD UNIQUE KEY `UNIQUE` (`nomor_pembayaran`),
  ADD KEY `INDEX` (`id_muzakki`,`id_amil`,`id_bank`);

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
  MODIFY `id_amil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `id_banner` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_donatur`
--
ALTER TABLE `tb_donatur`
  MODIFY `id_donatur` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_kategoriprogram`
--
ALTER TABLE `tb_kategoriprogram`
  MODIFY `id_kategoriprogram` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_latarbelakang`
--
ALTER TABLE `tb_latarbelakang`
  MODIFY `id_latarbelakang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mesjid`
--
ALTER TABLE `tb_mesjid`
  MODIFY `id_mesjid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_muzakki`
--
ALTER TABLE `tb_muzakki`
  MODIFY `id_muzakki` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_norek`
--
ALTER TABLE `tb_norek`
  MODIFY `id_norek` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_program`
--
ALTER TABLE `tb_program`
  MODIFY `id_program` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_views`
--
ALTER TABLE `tb_views`
  MODIFY `id_views` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;