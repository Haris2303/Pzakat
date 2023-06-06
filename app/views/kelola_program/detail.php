<!-- heading page -->
<h2 class="h3">Detail <?= $data['dataProgram']['nama_program'] ?></h2>

<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Berikut detail dari <?= $data['dataProgram']['nama_program'] ?></h6>

  </div>


  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table cellpadding="5">
        <tr>
          <th>Nama Program</th>
          <td>: <?= $data['dataProgram']['nama_program'] ?></td>
        </tr>
        <tr>
          <th>Jenis Program</th>
          <td>: <?= $data['dataProgram']['jenis_program'] ?></td>
        </tr>
        <tr>
          <th>Jenis Pembayaran</th>
          <td>: <?= $data['dataProgram']['jenis_pembayaran'] ?></td>
        </tr>
        <tr>
          <th>Deskripsi Program</th>
          <td>: <?= $data['dataProgram']['deskripsi_program'] ?></td>
        </tr>
        <tr>
          <th>Total Dana Saat ini</th>
          <td>: Rp. <?= $data['dataProgram']['total_dana'] ?></td>
        </tr>
        <tr>
          <th>Jumlah Donatur</th>
          <td>: <?= $data['dataProgram']['jumlah_donatur'] ?> </td>
        </tr>
        <tr>
          <th>Gambar</th>
          <td>: <img src="<?= BASEURL ?>/img/program/<?= $data['dataProgram']['gambar'] ?>" alt="Gambar Zakat" width="150"></td>
        </tr>
        <tr>
            <td>
                <label class="form-label"><strong>Content</strong></label>
                <div class="mb-3">
                    <?= $data['dataProgram']['content'] ?>
                </div>
            </td>
        </tr>
        <tr>
            <td>Dibuat pada <?= $data['dataProgram']['datetime'] ?></td>
        </tr>
      </table>
    </div>
    <div class="mt-3">
      <a href="<?= BASEURL ?>/kelola_program/<?= strtolower($data['dataProgram']['jenis_program']) ?>" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
    </div>
  </div>
</div>