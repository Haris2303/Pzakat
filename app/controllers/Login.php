<?php

class Login extends Controller {

  public function index(): void {
    $data['judul'] = 'Login';
    $this->view('login/index', $data);
  }

  public function aksi_login(): void {
    // pengecekkan login valid
    if( $this->model('Login_model')->login($_POST) > 0) {
      Flasher::setFlash('Login', 'berhasil', 'success');
      if($_SESSION['level'] === '3') header('Location: ' . BASEURL . '/');
      else if($_SESSION['level'] === '2') header('Location: ' . BASEURL . '/dashboard');
      exit;
    } else {
      Flasher::setFlash('Login', 'gagal', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }
  }

}