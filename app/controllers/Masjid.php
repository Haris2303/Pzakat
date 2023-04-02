<?php

class Masjid extends Controller {

  public function index(): void {
    $data['judul'] = 'Masjid';
    $this->view('dashboard/sidebar', $data);
    $this->view("masjid/index", $data);
    $this->view('dashboard/footer', $data);
  }

}