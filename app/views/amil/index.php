<!-- Page Heading -->
<h2 class="h3">Amil</h2>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-0">
      <div>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Data Amil</h6>
      </div>
      <div class="position-relative">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#exampleModal">
          Tambah <i class="ml-1 fas fa-plus-circle"></i>
        </button>
      </div>
    </div>
  </div>
  <div class="container mt-3">
    <!-- Button trigger modal -->
    <?php Flasher::flash() ?>
  </div>


  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Status Aktivasi</th>
            <th>Terakhir Login</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataAmil'] as $item) : ?>
            <tr>
              <td><?= $item['nama'] ?></td>
              <td><?= $item['email'] ?></td>
              <td><?= $item['nohp'] ?></td>
              <th><?= ($item['status_aktivasi'] === '1') ?
                    '<span class="text-primary">Telah Aktivasi</span>' : '<span class="text-danger">Belum Aktivasi</span>' ?>
              </th>
              <td><?= $item['waktu_login'] ?></td>
              <td>
                <a href="<?= BASEURL ?>/amil/detail/<?= $item['username'] ?>" class="btn badge btn-secondary">Detail</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title fs-5" id="exampleModalLabel">Tambah User Amil</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>

      <form action="<?= BASEURL ?>/amil/aksi_tambah_amil" method="post">

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
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Keluar</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
        </div>
      </form>

    </div>
  </div>
</div>