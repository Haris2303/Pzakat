<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Pembayaran <span class="text-dark">Pending</span></h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center px-2">
      <div>
        <h6 class="m-0 font-weight-bold text-dark">Data Pembayaran Pending</h6>
      </div>
      <div class="position-relative">
        <a href="<?= BASEURL ?>/kelola_pembayaran/konfirmasi" class="btn btn-primary mr-2"><span>Konfirmasi</span>
          <?php if ($data['countKonfirmasi'] > 0) : ?>
            <span class="badge badge-danger badge-counter position-absolute"><?= ($data['countKonfirmasi'] <= 99) ? $data['countKonfirmasi'] : '99' ?>+</span>
          <?php endif ?>
        </a>
        <a href="<?= BASEURL ?>/kelola_pembayaran/success" class="btn btn-success mr-2">Berhasil</a>
        <a href="<?= BASEURL ?>/kelola_pembayaran/failed" class="btn btn-danger">Gagal</a>
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
            <th>Kode Pembayaran</th>
            <th>Jumlah Donasi</th>
            <th>Tenggat Waktu</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataPending'] as $item) : ?>
            <?php
            // waktu expired dari kode
            var_dump($item['nomor_pembayaran']);
            $kode_expired = explode('_', $item['nomor_pembayaran'])[1] + (24 * 3600);
            $tenggat_waktu = date('M-d H:i', $kode_expired);
            ?>
            <tr>
              <td><?= $item['nama_donatur'] ?></td>
              <td><?= explode("_", $item['nomor_pembayaran'])[0] ?></td>
              <td>Rp <?= number_format($item['jumlah_pembayaran'], 0, ',', '.') ?></td>
              <td><?= (time() > $kode_expired)? '<span class="text-danger">Expired</span>' : '<span class="text-dark">'.$tenggat_waktu  .'</span>' ?></td>
              <td>
                <a href="<?= BASEURL ?>/kelola_pembayaran/detail/<?= $item['id_donatur'] ?>" class="btn badge btn-secondary">Detail</a>
                <?php if(time() > $kode_expired): ?>
                  <form action="<?= BASEURL ?>/kelola_pembayaran/aksi_hapus_data" method="post" id="form-delete" class="d-inline">
                    <input type="hidden" name="pembayaran" value="pending">
                    <input type="hidden" name="id" id="id" value="<?= $item['id_donatur'] ?>">
                    <button type="submit" id="btn-delete" class="btn badge btn-danger" data-id="<?= $item['id_donatur'] ?>">Hapus</button>
                  </form>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>