<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Banner</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-0">
      <div>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Data Banner</h6>
      </div>
      <div class="position-relative">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-add-data-banner" data-toggle="modal" data-target="#formModal">
          <i class="fas fa-plus"></i> Banner
        </button>
      </div>
    </div>
  </div>


  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" id="dataTable" cellspacing="0">
        <thead>
          <tr>
            <th>Gambar</th>
            <th>Link</th>
            <th>Ditambahkan oleh</th>
            <th>Terakhir Upload</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataBanner'] as $item) : ?>
            <tr>
              <td><img src="<?= BASEURL ?>/img/banner/<?= $item['gambar'] ?>" alt="Gambar Banner" width="150"></td>
              <td><?= $item['link'] ?></td>
              <td><?= $item['username'] ?></td>
              <td><?= $item['datetime'] ?></td>
              <td>
                <form action="<?= BASEURL ?>/banner/aksi_hapus_banner/" method="post">
                  <input type="hidden" name="id" value="<?= $item['id_banner'] ?>">
                  <button type="submit" class="btn badge btn-danger" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i> Hapus</button>
                </form>
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
        <h1 class="modal-title fs-5" id="formModalLabel">Tambah Data </h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
      </div>

      <form action="" method="post" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="mb-3 text-right">
            <span>Saran ukuran (1150x430)</span>
          </div>
          <input type="hidden" name="username_amil" value="<?= $_SESSION['username'] ?>">
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" class="form-control" id="gambar" name="gambar" required autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="text" name="link" id="link" class="form-control">
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