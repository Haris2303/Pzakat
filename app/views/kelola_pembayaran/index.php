<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Kelola Pembayaran <span class="text-warning">Tunai</span></h2>
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
            <a href="<?= BASEURL ?>/kelola_pembayaran/pending" class="btn btn-secondary mr-2"><span>Pending</span>
                <?php if($data['countPending'] > 0): ?>
                    <span class="badge badge-danger badge-counter position-absolute ml-5 d-block"><?= ($data['countPending'] <= 99) ? $data['countPending'] : '99'?>+</span>
                <?php endif ?>
            </a>
            <a href="<?= BASEURL ?>/kelola_pembayaran/konfirmasi" class="btn btn-primary mr-2"><span>Konfirmasi</span>
                <?php if($data['countKonfirmasi'] > 0): ?>
                    <span class="badge badge-danger badge-counter position-absolute"><?= ($data['countKonfirmasi'] <= 99) ? $data['countKonfirmasi'] : '99'?>+</span>
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
            <th>Nama Bank</th>
            <th>Jumlah Donasi (Rp)</th>
            <th>Tanggal Pembayaran</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataPembayaran'] as $item) : ?>
            <tr>
              <td><?= $item['nama_donatur'] ?></td>
              <td><?= $item['nama_bank'] ?></td>
              <td><?= number_format($item['jumlah_pembayaran'], 0, ',', '.') ?></td>
              <td><?= $item['tanggal_pembayaran'] ?></td>
              <td>
                <?php 
                  switch ($item['status_pembayaran']) {
                    case 'success':
                      $btnColor = 'success';
                      break;
                    case 'pending':
                      $btnColor = 'info';
                      break;
                    case 'konfirmasi':
                      $btnColor = 'primary';
                      break;
                    default:
                      $btnColor = 'danger';
                      break;
                  }
                ?>
                  <a href="<?= BASEURL ?>/kelola_pembayaran/detail/<?= $item['id_donatur'] ?>" class="btn badge btn-<?= $btnColor ?>"><?= $item['status_pembayaran'] ?></a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>