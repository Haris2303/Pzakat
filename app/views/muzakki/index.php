<!-- Page Heading -->
<h2 class="h3">Muzakki</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">DataTables Muzakki</h6>
  </div>

  <div class="container mt-3">
    <!-- flasher alert -->
    <?php Flasher::flash() ?>
  </div>

  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Terakhir Login</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['dataMuzakki'] as $item) : ?>
            <tr>
              <td><?= $item['nama'] ?></td>
              <td><?= $item['username'] ?></td>
              <td><?= $item['email'] ?></td>
              <td><?= $item['nohp'] ?></td>
              <td><?= $item['waktu_login'] ?></td>
              <td>
                <form action="" id="form-delete">
                  <button type="submit" id="btn-delete" class="btn badge btn-danger" data-uuid="<?= $item['id_user'] ?>">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>