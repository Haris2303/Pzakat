<!-- Page Heading -->
<h2 class="h3">Berita</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">DataTables Berita</h6>
  </div>

  <div class="container mt-3">
    <!-- Button trigger modal -->
    <a href="<?= BASEURL ?>/pageviews/uploadberita" class="btn btn-primary">
      Tambah Berita
    </a>
  </div>

  <?php Flasher::flash() ?>
  
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Penulis</th>
            <th>Judul</th>
            <th>Gambar</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataBerita'] as $item) : ?>
            <tr>
              <td><?= $item['nama_penulis'] ?></td>
              <td><?= $item['judul'] ?></td>
              <td><img src="<?= BASEURL?>/img/views/<?= $item['gambar'] ?>" alt="" width="70"></td>
              <td>
                <a href="<?= BASEURL ?>/berita/detail/<?= $item['slug'] ?>" class="btn badge btn-secondary">Detail</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="beritaModalLabel">Upload Berita</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= BASEURL ?>/" method="post">

        <div class="modal-body">
          
          
          <!-- <textarea name="content" id="default"></textarea> -->

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
      </form>

    </div>
  </div>
</div>
