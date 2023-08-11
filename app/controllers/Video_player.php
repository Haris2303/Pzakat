<?php

class Video_player extends Controller
{

    /**
     * Konstruktor kelas, digunakan untuk memastikan akses hanya diberikan kepada admin
     */
    public function __construct()
    {
        // Memeriksa apakah pengguna memiliki level admin (level '1')
        if ($_SESSION['level'] !== '1') {
            // Jika bukan admin, arahkan kembali ke halaman utama dan keluar dari skrip
            header('Location: ' . BASEURL . '/');
            exit;
        }
    }

    /**
     * Menampilkan halaman pemutar video YouTube
     * @method index
     */
    public function index(): void
    {
        // Mengambil data video dari model Video_model
        $video = $this->model('Video_model')->getData();

        // Mempersiapkan data yang akan ditampilkan di halaman
        $data = [
            "judul" => "Youtube Video Player",
            "src" => $video['link'],    // Link video YouTube yang akan ditampilkan
            "time" => $video['datetime'] // Informasi waktu video (misalnya, waktu publikasi)
        ];

        // Memanggil tampilan untuk menghasilkan halaman
        $this->view('dashboard/sidebar', $data);        // Tampilan sidebar (asumsi)
        $this->view('video_player/index', $data);       // Tampilan konten utama dengan pemutar video (asumsi)
        $this->view('dashboard/footer', $data);         // Tampilan footer (asumsi)
    }

    /**
     * Aksi untuk mengubah sumber video
     * @method aksi_ubah_source
     */
    public function aksi_ubah_source(): void
    {
        // Mencoba mengubah data sumber video menggunakan model Video_model
        $result = $this->model('Video_model')->ubahData($_POST);

        if ($result > 0) {
            // Jika pengubahan berhasil, set pesan sukses, dan kembali ke halaman pemutar video
            Flasher::setFlash('Source berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/video_player');
            exit;
        } else {
            // Jika pengubahan gagal, set pesan gagal, dan kembali ke halaman pemutar video
            Flasher::setFlash('Source gagal diubah', 'danger');
            header('Location: ' . BASEURL . '/video_player');
            exit;
        }
    }
}
