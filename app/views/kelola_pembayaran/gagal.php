<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Pembayaran Gagal</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Data Tabel Pembayaran Pending</h6>
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
          <?php foreach ($data['dataKonfirmasi'] as $item) : ?>
            <tr>
              <td><?= $item['nama_donatur'] ?></td>
              <td><?= $item['nama_bank'] ?></td>
              <td><?= $item['jumlah_pembayaran'] ?></td>
              <td><?= $item['tanggal_pembayaran'] ?></td>
              <td>
                <a href="<?= BASEURL ?>/masjid/aksi_hapus_mesjid/<?= $item['id_donatur'] ?>" class="btn badge btn-warning">Konfirmasi</a>
                <a href="<?= BASEURL ?>/masjid/aksi_hapus_mesjid/<?= $item['id_donatur'] ?>" class="btn badge btn-secondary">Detail</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>