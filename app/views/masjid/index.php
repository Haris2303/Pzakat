<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Masjid</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-0">
      <div>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Masjid</h6>
      </div>
      <div class="position-relative">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-add-data-masjid" data-toggle="modal" data-target="#formModal">
          Tambah Masjid <i class="ml-1 fas fa-plus-circle"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Masjid</th>
            <th>Alamat Masjid</th>
            <th>RT</th>
            <th>RW</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataMasjid'] as $item) : ?>
            <tr>
              <td><?= $item['nama_mesjid'] ?></td>
              <td><?= $item['alamat_mesjid'] ?></td>
              <td><?= $item['RT'] ?></td>
              <td><?= $item['RW'] ?></td>
              <td>
                <a href="<?= BASEURL ?>/masjid/ubah/<?= $item['id_mesjid'] ?>" class="btn badge btn-success btn-update-data-masjid" data-id="<?= $item['id_mesjid'] ?>" data-toggle="modal" data-target="#formModal">Ubah</a>
                <a href="<?= BASEURL ?>/masjid/aksi_hapus_mesjid/<?= $item['id_mesjid'] ?>" class="btn badge btn-danger">Hapus</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="formModalLabel">Tambah Data Masjid</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>

      <form action="<?= BASEURL ?>/masjid/aksi_tambah_mesjid" method="post">

        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <label for="nama_mesjid" class="form-label">Nama Masjid</label>
            <input type="text" class="form-control" id="nama_mesjid" name="nama_mesjid" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="alamat_mesjid" class="form-label">Alamat Masjid</label>
            <textarea name="alamat_mesjid" id="alamat_mesjid" class="form-control" rows="1"></textarea>
          </div>
          <div class="mb-3">
            <label for="RT" class="form-label">RT</label>
            <input type="text" class="form-control" id="RT" name="RT" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="RW" class="form-label">RW</label>
            <input type="text" class="form-control" id="RW" name="RW" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="provinsi" class="form-label">Provinsi</label>
            <select id="browsers" name="provinsi" class="form-control" required>
            </select>
          </div>
          <div class="mb-3">
            <label for="provinsi" class="form-label">Kota/Kab</label>
            <select id="browsers_regencies" name="kabupaten" class="form-control" required>
            </select>
          </div>
          <div class="mb-3">
            <label for="provinsi" class="form-label">Kecamatan</label>
            <select id="browsers_districts" name="kecamatan" class="form-control" required>
            </select>
          </div>
          <div class="mb-3">
            <label for="provinsi" class="form-label">Kelurahan</label>
            <select id="browsers_villages" name="kelurahan" class="form-control" required>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>

    </div>
  </div>
</div>