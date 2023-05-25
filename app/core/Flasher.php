<?php 

class Flasher {

  public static function setFlash($pesan, $tipe): array {
    return $_SESSION['flash'] = [
      'pesan' => $pesan,
      'tipe'  => $tipe
    ];
  }

  public static function flash(): void {
    if( isset($_SESSION['flash']) ) {
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">' . $_SESSION['flash']['pesan'] . '.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
            </div>';
      unset($_SESSION['flash']);
    }
  }

}