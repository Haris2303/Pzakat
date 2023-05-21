<?php 

class Flasher {

  public static function setFlash($pesan, $aksi, $tipe): array {
    return $_SESSION['flash'] = [
      'pesan' => $pesan,
      'aksi'  => $aksi,
      'tipe'  => $tipe
    ];
  }

  public static function flash(): void {
    if( isset($_SESSION['flash']) ) {
      echo $_SESSION['flash']['pesan'] . ' ' . $_SESSION['flash']['aksi'];
      unset($_SESSION['flash']);
    }
  }

}