<!-- Page Heading -->
<h2 class="h3 text-dark">Detail Pembayaran Barang</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-1">
      <h6 class="m-0 font-weight-bold text-dark">Detail Pembayaran Barang</h6>
    <a href="<?= BASEURL ?>/kelola_pembayaran/aksi_hapus_pembayaran/<?= $data['detail']['id_donasibarang'] ?>" class="btn btn-danger" onclick="return confirm('Anda akan menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
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
          <th>Jenis Program</th>
          <td>: <?= $data['detail']['jenis_program'] ?></td>
        </tr>
        <tr>
          <th>Jumlah Berat Donasi</th>
          <td>: <?= Utility::convertGramToKilogram((int)$data['detail']['berat_barang']) ?> kg</td>
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
            <th>Bukti Barang</th>
            <td><a href="#"><img src="<?= BASEURL ?>/img/bukti_barang/<?= $data['detail']['bukti_barang'] ?>" alt="Gambar Bukti Pembayaran" width="150px" data-target="#exampleModal" data-toggle="modal"></a></td>
        </tr>
        <tr>
            
        </tr>
      </table>
    </div>
    <div class="mt-3">
      <a href="<?= BASEURL ?>/kelola_pembayaran/barang" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title fs-5" id="exampleModalLabel">Bukti Barang</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>
      
      <div class="p-3">
        <img src="<?= BASEURL ?>/img/bukti_barang/<?= $data['detail']['bukti_barang'] ?>" alt="Gambar Bukti Pembayaran" width="100%">
      </div>

    </div>
  </div>
</div>