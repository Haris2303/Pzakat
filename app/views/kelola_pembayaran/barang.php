<!-- Page Heading -->
<h2 class="h3">Kelola Pembayaran <span class="text-primary">Barang</span></h2>
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
          Tambah Barang <i class="ml-1 fas fa-plus-circle"></i>
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
            <th>Nama Donatur</th>
            <th>Nama Program</th>
            <th>Jenis Barang</th>
            <th>Berat Barang</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataBarang'] as $item) : ?>
            <tr>
              <td><?= ucwords($item['nama_donatur']) ?></td>
              <td><?= $item['nama_program'] ?></td>
              <td><?= ucwords($item['jenis_barang']) ?></td>
              <td><?= Utility::convertGramToKilogram((int)$item['berat_barang']) ?>kg</td>
              <td>
                <a href="<?= BASEURL ?>/kelola_pembayaran/detailbarang/<?= $item['id_donasibarang'] ?>" class="btn badge btn-secondary">Detail</a>
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
        <h3 class="modal-title fs-5" id="formModalLabel">Tambah Data Zakat Barang</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>

      <form action="<?= BASEURL ?>/kelola_pembayaran/aksi_pembayaran_barang" method="post" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="mb-3">
            <label for="nama_program" class="form-label">Nama Program</label>
            <select name="slug-program" id="nama_program" class="form-control">
              <option selected disabled>-- Pilih Nama Program --</option>
              <?php foreach($data['namaBarang'] as $item): ?>
                <option value="<?= $item['slug'] ?>"><?= $item['nama_program'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="jenis-barang" class="form-label">Jenis Barang</label>
            <select name="jenis-barang" class="form-control" id="jenis-barang" required>
                <option value="beras">Beras</option>
                <option value="emas">Emas</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="berat-barang" class="form-label">Berat Barang (1000g / 1kg)</label>
            <input type="text" name="berat-barang" id="berat-barang" class="form-control" placeholder="Masukkan Gram, Ex: 1000" required>
          </div>
          <div class="mb-3">
            <label for="nama-donatur" class="form-label">Nama Donatur</label>
            <input type="text" name="nama-donatur" id="nama-donatur" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="example@gmail.com" required>
          </div>
          <div class="mb-3">
            <label for="nohp" class="form-label">Nomor Telepon</label>
            <input type="text" name="nohp" id="nohp" class="form-control" required>
          </div>
          <div class="mb-3">
            <label for="pesan" class="form-label">Pesan</label>
            <textarea name="pesan" id="pesan" class="form-control" rows="3" placeholder="(optional)"></textarea>
          </div>
          <div class="mb-3">
            <label for="gambar" class="form-label">Bukti Barang</label>
            <input type="file" name="gambar" id="gambar" class="form-control">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Keluar</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Selanjutnya</button>
        </div>
      </form>

    </div>
  </div>
</div>