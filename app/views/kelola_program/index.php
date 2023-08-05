<!-- Page Heading -->
<h2 class="h3">Kelola Program</h2>

<!-- DataTales -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-dark">Data Program Tersedia</h6>
  </div>
  
  <div class="card-body">
    <?php Flasher::flash() ?>
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Nama Program</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($data['program'] as $item): ?>
            <tr>
              <td><?= $item['nama_kategoriprogram'] ?></td>
              <td>
                <form action="<?= BASEURL ?>/kelola_program/aksi_status_program" method="post">
                  <input type="hidden" name="id" value="<?= $item['id_kategoriprogram'] ?>">
                  <input type="hidden" name="status" value="<?= $item['status'] ?>">
                  <button type="submit" class="btn badge btn-<?= ($item['status'] === 'aktif') ? 'success' : 'danger' ?>"><?= ($item['status'] === 'aktif') ? 'Aktif' : 'Nonaktif'?></button>
                </form>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>