<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Pembayaran Pending</h2>
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
            <th>Nama Masjid</th>
            <th>Alamat Masjid</th>
            <th>RT</th>
            <th>RW</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataPending'] as $item) : ?>
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