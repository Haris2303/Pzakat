<?php

class Userlogout extends Controller
{
  public function index()
  {
    // Mengarahkan pengguna ke halaman "userlogout/index"
    $this->view('userlogout/index');
    // Kemungkinan ada kode tambahan di sini untuk proses logout sesungguhnya
    // Misalnya, menghapus sesi atau melakukan tindakan lain
  }
}
