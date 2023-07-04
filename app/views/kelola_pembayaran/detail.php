<!-- Page Heading -->
<h2 class="h3">Detail Pembayaran</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-1">
      <h6 class="m-0 font-weight-bold text-dark">Detail Kode Pembayaran <?= $data['detail']['nomor_pembayaran'] ?></h6>
      <?php if($data['detail']['status_pembayaran'] !== 'success'): ?>
        <a href="<?= BASEURL ?>/kelola_pembayaran/aksi_hapus_pembayaran/<?= $data['detail']['status_pembayaran'] ?>/<?= $data['detail']['id_donatur'] ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus data <?= $data['detail']['nomor_pembayaran'] ?>?')"><i class="fas fa-trash"></i> Hapus</a>
      <?php endif ?>
    </div>
  </div>

  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table cellpadding="5">
        <tr>
          <th>Nama Donatur</th>
          <td>: <?= $data['detail']['nama_donatur'] ?></td>
        </tr>
        <tr>
          <th>Nama Program</th>
          <td>: <?= $data['detail']['nama_program'] ?></td>
        </tr>
        <tr>
          <th>Jenis Program</th>
          <td>: <?= $data['detail']['jenis_program'] ?></td>
        </tr>
        <tr>
          <th>Jumlah Donasi</th>
          <td>: Rp <?= number_format($data['detail']['jumlah_pembayaran'],0,',', '.') ?></td>
        </tr>
        <tr>
          <th>No Handphone</th>
          <td>: <?= $data['detail']['nohp'] ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td>: <?= $data['detail']['email'] ?></td>
        </tr>
        <tr>
          <th>Pesan</th>
          <td>: <?= $data['detail']['pesan'] ?> </td>
        </tr>
        <tr>
          <th>Nomor Rekening</th>
          <td>: <?= $data['detail']['norek'] ?></td>
        </tr>
        <tr>
            <th>Nama Pemilik Rekening</th>
            <td>: <?= $data['detail']['nama_pemilik'] ?></td>
        </tr>
        <tr>
            <th>Bukti Pembayaran</th>
            <td><a href="#"><img src="<?= BASEURL ?>/img/bukti_pembayaran/<?= $data['detail']['bukti_pembayaran'] ?>" alt="Gambar Bukti Pembayaran" width="150px" data-target="#exampleModal" data-toggle="modal"></a></td>
        </tr>
        <tr>
            
        </tr>
      </table>
    </div>
    <div class="mt-3">
      <a href="<?= BASEURL ?>/kelola_pembayaran/<?= $data['detail']['status_pembayaran'] ?>" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
      <?php if($data['detail']['status_pembayaran'] === 'konfirmasi'):?>
        <a href="<?= BASEURL ?>/kelola_pembayaran/aksi_konfirmasi_pembayaran/<?= $data['detail']['slug_program'] ?>/<?= $data['detail']['status_pembayaran'] ?>/<?= $data['detail']['id_donatur'] ?>/<?= $_SESSION['username'] ?>/<?= $data['detail']['jumlah_pembayaran'] ?>/<?= join('-', explode(' ',$data['detail']['nama_bank'])) ?>" class="btn btn-primary"><i class="fas fa-arrow-alt-circle-left"></i> Konfirmasi</a>
      <?php endif ?>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Bukti Pembayaran</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      
      <div class="p-3">
        <img src="<?= BASEURL ?>/img/bukti_pembayaran/<?= $data['detail']['bukti_pembayaran'] ?>" alt="Gambar Bukti Pembayaran" width="100%">
      </div>

    </div>
  </div>
</div>