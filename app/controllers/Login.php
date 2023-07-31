<?php

class Login extends Controller {

  public function index(): void {
    $data['judul'] = 'Login';
    $this->view('template/normalheader', $data);
    $this->view('login/index', $data);
    $this->view('template/normalfooter', $data);
  }

  public function aksi_login(): void {
    $result = $this->model('Login_model')->login($_POST);
    // pengecekkan login valid
    if($result > 0 && is_int($result)) {
      switch ($_SESSION['level']) {
        case '3':
          header('Location: ' . BASEURL . '/user_dashboard');
          break;
        case '2':
          header('Location: ' . BASEURL . '/dashboard');
          break;
        default:
          header('Location: ' . BASEURL . '/');
          break;
      }
      exit;
    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }
  }

  /**
   * 
   * @method Forgot Password
   * @param Email&Token
   * 
   */
  public function lupa_password(): void {
    $data['judul'] = "Lupa Password?";
    $this->view('template/normalheader', $data);
    $this->view('login/lupa_password', $data);
    $this->view('template/normalfooter', $data);
  }

  public function aksi_reset_password(): void {
    $email = $_POST['email'];

    // check email
    $isEmail = $this->model('Login_model')->checkEmail($email);
    if($isEmail <= 0) {
      Flasher::setFlash('Gagal Lupa Password! Email tidak terdaftar', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // get user id
    $user_id = $this->model('Login_model')->getUserId($email);

    // set session user id
    $_SESSION['user_id'] = $user_id;

    // generate token
    $token = base64_encode(random_bytes(32));
    // delete character '/' and '='
    $token = trim($token, '=');
    $token = explode('/', $token); 
    $token = join('', $token);
    $token = explode('+', $token);
    $token = urlencode(join('', $token));

    // update token
    $token = $this->model('Login_model')->updateToken($token, $user_id);

    // send email
    $message = 'Klik link berikut untuk mengubah password Anda: ' . BASEURL . '/login/ubah_password/' . $email . '/' . $token;
    $email = Utility::sendEmail($email, 'Lupa Password', $message);

    if($email) {
      Flasher::setFlash('Pesan Berhasil terkirim! Silahkan cek email Anda', 'success');
      header('Location: '. BASEURL . '/login/lupa_password');
      exit;
    }
  }

  public function aksi_ubah_password(): void {

    $email = $_SESSION['email'];
    $token = $_SESSION['token'];
    $user_id = $_SESSION['user_id'];

    $result = $this->model('Login_model')->ubahPassword($_POST);

    if($result > 0 && is_int($result)) {

      // generate token
      $token = base64_encode(random_bytes(32));
      // delete character '/' and '='
      $token = trim($token, '=');
      $token = join('', explode('/', $token)); 
      $token = join('', explode('+', $token));
      $token = urlencode($token);

      $isToken = $this->model('Login_model')->updateToken($token, $user_id);

      if(is_string($isToken)) {

        unset($_SESSION['ubah_password']);
        unset($_SESSION['email']);
        unset($_SESSION['token']);
        unset($_SESSION['user_id']);

        Flasher::setFlash('Password berhasil diubah! Silahkan login.', 'success');
        header('Location: ' . BASEURL . '/login');
        exit;

      }


    } else {
      Flasher::setFlash($result, 'danger');
      header('Location: ' . BASEURL . '/login/ubah_password/' . $email . '/' . $token);
      exit;
    }
    
  }

  public function ubah_password(string $email = NULL, string $token = NULL): void {

    // is not get
    if(is_null($email) && is_null($token)) {
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // check email
    $isEmail = $this->model('Login_model')->checkEmail($email);
    if($isEmail <= 0) {
      Flasher::setFlash('Gagal Ubah Password! Email tidak valid!', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // check token
    $isToken = $this->model('Login_model')->checkToken($token);
    if(is_bool($isToken)) {
      Flasher::setFlash('Gagal Ubah Password! Token tidak valid atau expired', 'danger');
      header('Location: ' . BASEURL . '/login');
      exit;
    }

    // set session token and email
    $_SESSION['email'] = $email;
    $_SESSION['token'] = $token;

    // set session
    $_SESSION['ubah_password'] = true;
    
    // if session expired
    if(!isset($_SESSION['ubah_password'])) {
      header('Location: '. BASEURL . '/login');
      exit;
    }

    $data['judul'] = "Ubah Password";
    $data['token'] = $token;
    $this->view('template/normalheader', $data);
    $this->view('login/ubah_password', $data);
    $this->view('template/normalfooter', $data);

  }

}