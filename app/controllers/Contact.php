<?php

class Contact extends Controller {

  public function index(): void {
    $data['judul'] = 'Contact Us';
    $this->view('template/header', $data);
    $this->view('contact/index', $data);
    $this->view('template/footer', $data);
  }

}