<!-- Page Heading -->
<h2 class="h3">Amil</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Detail Amil</h6>

  </div>

  <?php Flasher::flash() ?>

  <div class="card-body">
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
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Ubah
      </button>
  
      <a href="#" class="btn btn-danger">Hapus</a>
      <a href="<?= BASEURL ?>/amil" class="btn btn-secondary">Kembali</a>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User Admin</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= BASEURL ?>/useradmin/aksi_tambah_amil" method="post">

        <div class="modal-body">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Amil</label>
            <input type="text" class="form-control" id="nama" name="name" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="nohp" class="form-label">No Handphone</label>
            <input type="tel" class="form-control" id="nohp" name="nohp" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="tel" class="form-control" id="alamat" name="alamat" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="masjid" class="form-label">Masjid</label>
            <select name="masjid" id="masjid" class="form-control" required>
              <option disabled selected> -- Pilih Masjid -- </option>
              <?php foreach ($data['dataMasjid'] as $item) : ?>
                <option value="<?= $item['id_mesjid'] ?>"><?= $item['nama_mesjid'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="password2" class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="password2" name="passConfirm" required autocomplete="off">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>

    </div>
  </div>
</div>