<!-- Page Heading -->
<h2 class="h3">Amil</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Detail Amil</h6>

  </div>


  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table cellpadding="5">
        <tr>
          <th>Username</th>
          <td>: <?= $data['detail']['username'] ?></td>
        </tr>
        <tr>
          <th>Nama Lengkap</th>
          <td>: <?= $data['detail']['nama'] ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td>: <?= $data['detail']['email'] ?></td>
        </tr>
        <tr>
          <th>No Handphone</th>
          <td>: <?= $data['detail']['nohp'] ?></td>
        </tr>
        <tr>
          <th>Alamat</th>
          <td>: <?= $data['detail']['alamat'] ?></td>
        </tr>
        <tr>
          <th></th>
        </tr>
        <tr>
          <th>Nama Masjid</th>
          <td>: <?= $data['masjid']['nama_mesjid'] ?> </td>
        </tr>
        <tr>
          <th>Alamat Masjid</th>
          <td>: <?= $data['masjid']['alamat_mesjid'] ?></td>
        </tr>
        <tr>
          <th>RT / RW</th>
          <td>: <?= $data['masjid']['RT'] ?>/<?= $data['masjid']['RW'] ?></td>
        </tr>
      </table>
    </div>
    <div class="mt-3">
      <!-- Button trigger modal ubah -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        <i class="fas fa-edit"></i> Ubah Password
      </button>

      <a href="<?= BASEURL ?>/amil/aksi_hapus_amil/<?= $data['detail']['id_user'] ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a>
      <a href="<?= BASEURL ?>/amil" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
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