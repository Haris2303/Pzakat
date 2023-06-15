<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Pembayaran</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3 mx-2">
    <div class="row justify-content-between align-items-center">
        <div>
            <h6 class="m-0 font-weight-bold text-dark">Data Tabel Kelola Pembayaran</h6>
        </div>
        <div class="position-relative">
            <!-- Button trigger modal -->
            <a href="<?= BASEURL ?>/kelola_pembayaran/konfirmasi" class="btn btn-primary mr-3"><span>Konfirmasi</span><span class="badge badge-danger badge-counter position-absolute"><?= ($data['countKonfirmasi'] <= 99) ? $data['countKonfirmasi'] : '99'?>+</span></a>
            <a href="<?= BASEURL ?>/kelola_pembayaran/berhasil" class="btn btn-success">Berhasil</a>
            <a href="<?= BASEURL ?>/kelola_pembayaran/gagal" class="btn btn-danger">Gagal</a>
        </div>
    </div>
  </div>
  
  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Donatur</th>
            <th>Nama Bank</th>
            <th>Jumlah Donasi</th>
            <th>Tanggal Pembayaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataPembayaran'] as $item) : ?>
            <tr>
              <td><?= $item['nama_donatur'] ?></td>
              <td><?= $item['nama_bank'] ?></td>
              <td><?= $item['jumlah_pembayaran'] ?></td>
              <td><?= $item['tanggal_pembayaran'] ?></td>
              <td>
                <a href="<?= BASEURL ?>/kelola_pembayaran/detail/<?= $item['id_donatur'] ?>" class="btn badge btn-secondary">Detail</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>