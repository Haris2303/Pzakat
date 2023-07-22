<?php 

class Program extends Controller {

    public function index($slug = true): void
    {
        $data = [
            "judul" => "Program",
            "dataProgram" => $this->model('Kelolaprogram_model')->getDataProgramBySlug($slug)
        ];

        // jika halaman tidak ditemukan
        if(is_bool($data['dataProgram'])) {
            $this->view('error/404');
            exit;
        }

        $this->view('template/header', $data);
        $this->view('program/index', $data);
        $this->view('template/footer', $data);
    }

}