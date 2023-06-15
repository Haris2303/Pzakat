<!-- Page Heading -->
<h2 class="h3">Detail Pembayaran</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Detail Kode Pembayaran <?= $data['detail']['nomor_pembayaran'] ?></h6>

  </div>

  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table cellpadding="5">
        <tr>
          <th>Nama Donatur</th>
          <td>: <?= $data['detail']['nama_donatur'] ?></td>
        </tr>
        <tr>
          <th>Jenis Program</th>
          <td>: <?= $data['detail']['jenis_program'] ?></td>
        </tr>
        <tr>
          <th>Jumlah Donasi</th>
          <td>: <?= $data['detail']['jumlah_pembayaran'] ?></td>
        </tr>
        <tr>
          <th>No Handphone</th>
          <td>: <?= $data['detail']['nohp'] ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td>: <?= $data['detail']['email'] ?></td>
        </tr>
        <tr>
          <th>Pesan</th>
          <td>: <?= $data['detail']['pesan'] ?> </td>
        </tr>
        <tr>
          <th>Nomor Rekening</th>
          <td>: <?= $data['detail']['norek'] ?></td>
        </tr>
        <tr>
            <th>Nama Pemilik Rekening</th>
            <td>: <?= $data['detail']['nama_pemilik'] ?></td>
        </tr>
        <tr>
            <th>Bukti Pembayaran</th>
            <td><img src="<?= BASEURL ?>/img/bukti_pembayaran/<?= $data['detail']['bukti_pembayaran'] ?>" alt="Gambar Bukti Pembayaran" width="350px"></td>
        </tr>
        <tr>
            
        </tr>
      </table>
    </div>
    <div class="mt-3">
      <a href="<?= BASEURL ?>/kelola_pembayaran/<?= $data['detail']['status_pembayaran'] ?>" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Password Amil</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>

      <form action="<?= BASEURL ?>/amil/aksi_ubah_amil" method="post">

        <div class="modal-body">
          <input type="hidden" class="form-control" id="username" name="username" value="<?= $data['detail']['username'] ?>" required autocomplete="off">
          <div class="mb-3">
            <label for="password" class="form-label">Password Baru</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="password2" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password2" name="passConfirm" required autocomplete="off">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-window-close"></i> Keluar</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Ubah</button>
        </div>
      </form>

    </div>
  </div>
</div>