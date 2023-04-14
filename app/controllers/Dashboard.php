<?php

class Dashboard extends Controller{

  public function index(): void {
    $data['judul'] = 'Dashboard';
    $this->view('dashboard/sidebar', $data);
    $this->view('dashboard/index', $data);
    $this->view('dashboard/footer', $data);
  }

}