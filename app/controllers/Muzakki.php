<?php

class Muzakki extends Controller {

  public function index(): void {

    $data = [
      "judul" => 'Muzakki',
      "css" => VENDOR_TABLES_CSS,
      "script" => VENDOR_TABLES,
      "dataMuzakki" => $this->model('Muzakki_model')->getAllData(),
    ];

    $this->view('dashboard/sidebar', $data);
    $this->view('muzakki/index', $data);
    $this->view('dashboard/footer', $data);

  }

  /**
   * ------------------------------------------------------------------------------------------------------------------------------------------------------
   *                      METHOD ACTION DATA
   * ------------------------------------------------------------------------------------------------------------------------------------------------------
   */

   public function aksi_hapus_data(string $id): void 
   {
    $row = $this->model('User_model')->deleteData($id);
    if($row > 0) {
      Flasher::setFlash('Data Muzakki berhasil dihapus', 'success');
      header('Location: ' . BASEURL . '/muzakki');
      exit;
    } else {
      Flasher::setFlash('Data Muzakki gagal dihapus', 'danger');
      header('Location: ' . BASEURL . '/muzakki');
      exit;
    }
   }
  
}
