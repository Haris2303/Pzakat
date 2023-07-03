<!-- Page Heading -->
<h2 class="h3">Program Zakat <span class="text-warning">Uang</span></h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-0">
      <div>
        <h6 class="m-0 font-weight-bold text-dark">Data Program Zakat</h6>
      </div>
      <div class="position-relative">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#formModal">
          Tambah <i class="ml-1 fas fa-plus-circle"></i>
        </button>
        <a href="<?= BASEURL ?>/kelola_program/zakatbarang" class="btn btn-secondary">Barang <i class="ml-1 fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

  </div>


  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Program Zakat</th>
            <th>Total Dana (Rp)</th>
            <th>Jumlah Donatur</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataZakat'] as $item) : ?>
            <tr>
              <td><?= $item['nama_program'] ?></td>
              <td><?= number_format($item['total_dana'], 0, ',', '.') ?></td>
              <td><?= $item['jumlah_donatur'] ?></td>
              <td>
                <a href="<?= BASEURL ?>/kelola_program/detail/<?= $item['slug'] ?>" class="btn badge btn-secondary">Detail</a>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="formModalLabel">Tambah Data Zakat Uang</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>

      <form action="<?= BASEURL ?>/kelola_program/aksi_tambah_zakatuang" method="post" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_zakat" class="form-label">Nama Program Zakat</label>
            <input type="text" class="form-control" id="nama_zakat" name="nama-zakat" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" rows="1"></textarea>
          </div>
          <div class="mb-3">
            <label for="jenis-pembayaran" class="form-label">Jenis Pembayaran</label>
            <select id="browsers" name="jenis-pembayaran" class="form-control" required>
              <option value="uang">Uang (umum)</option>
              <option value="fidyah">Fidyah (umum)</option>
            </select>
          </div>
          <div class="mb-3 gambar-zakat">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
          </div>
          <div class="mb-3 content-zakat">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="default" class="form-control" rows="10"></textarea>
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