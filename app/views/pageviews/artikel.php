<!-- Page Heading -->
<h2 class="h3">Artikel</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row justify-content-between align-items-center mx-0">
      <div>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Data Artikel</h6>
      </div>
      <div class="position-relative">
        <a href="<?= BASEURL ?>/pageviews/upload/Artikel" class="btn btn-primary">
          Tambah Artikel <i class="ml-1 fas fa-plus-circle"></i>
        </a>
      </div>
    </div>
  </div>

  <div class="container mt-3">
    <?php Flasher::flash() ?>
  </div>


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
          <?php foreach ($data['dataArtikel'] as $item) : ?>
            <tr>
              <td><?= $item['nama_penulis'] ?></td>
              <td><?= $item['judul'] ?></td>
              <td><img src="<?= BASEURL ?>/img/views/<?= $item['gambar'] ?>" alt="" width="70"></td>
              <td>
                <a href="<?= BASEURL ?>/pageviews/detail/<?= $item['slug'] ?>" class="btn badge btn-secondary">Detail</a>
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