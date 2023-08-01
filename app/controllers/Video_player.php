<?php

class Video_player extends Controller {

    public function index(): void {
        $video = $this->model('Video_model')->getData();

        $data = [
            "judul" => "Youtube Video Player",
            "src" => $video['link'],
            "time" => $video['datetime']
        ];

        $this->view('dashboard/sidebar', $data);
        $this->view('video_player/index', $data);
        $this->view('dashboard/footer', $data);

    }

    public function aksi_ubah_source(): void {
        $result = $this->model('Video_model')->ubahData($_POST);
        if($result > 0) {
            Flasher::setFlash('Source berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/video_player');
            exit;
        } else {
            Flasher::setFlash('Source gagar diubah', 'danger');
            header('Location: ' . BASEURL . '/video_player');
            exit;
        }
    }

}