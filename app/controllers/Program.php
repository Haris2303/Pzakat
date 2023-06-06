<?php 

class Program extends Controller {

    public function index($slug): void
    {
        $data = ["judul" => "Program"];

        $this->view('template/header', $data);
        $this->view('program/index', $data);
        $this->view('template/footer', $data);
    }

}