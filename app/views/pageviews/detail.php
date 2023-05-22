<h2 class="h3">Detail <?= $data['dataView']['jenis_views'] ?></h2>
<?= Flasher::flash() ?>
<form action="<?= BASEURL ?>/pageviews/aksi_ubah_view" method="post" class="mt-3" enctype="multipart/form-data">
  <input type="hidden" name="slug" value="<?= $data['dataView']['slug'] ?>">
  <input type="hidden" name="jenis_view" value="<?= $data['dataView']['jenis_views'] ?>">
  <div class="mb-3">
    <label for="judul" class="form-label">Judul <?= $data['dataView']['jenis_views'] ?></label>
    <input type="text" name="judul" id="judul" class="form-control" value="<?= $data['dataView']['judul'] ?>" autocomplete="off">
  </div>
  <div class="mb-3">
    <label for="penulis" class="form-label">Penulis</label>
    <input type="text" name="penulis" id="penulis" class="form-control" value="<?= $data['dataView']['nama_penulis'] ?>" autocomplete="off">
  </div>
  <div class="mb-3">
    <label for="gambar" class="form-label">Gambar</label><br>
    <img src="<?= BASEURL ?>/img/views/<?= $data['dataView']['gambar'] ?>" alt="<?= $data['dataView']['gambar'] ?>" height="200px">
    <input type="hidden" name="gambarlama" value="<?= $data['dataView']['gambar'] ?>">
  </div>
  <div class="mb-3">
    <label for="gambarbaru" class="form-label">Upload Gambar Baru</label><br>
    <input type="file" name="gambar" id="gambarbaru">
  </div>
  <div class="mb-3">
    <label class="form-label">Isi Berita</label>
    <textarea name="content" id="default"><?= $data['dataView']['content'] ?></textarea>
  </div>
  <div class="mb-3">
    <label for="datetime" class="form-label">Terakhir Diupload pada <?= $data['dataView']['datetime'] ?></label>
  </div>
  <button type="submit" class="btn btn-success mt-3 mb-3"><i class="fas fa-edit"></i>Change</button>
  <a href="<?= BASEURL ?>/pageviews/aksi_hapus_view/<?= $data['dataView']['slug'] ?>" class="btn btn-danger mt-3 mb-3"><i class="fas fa-trash"></i> Delete</a>
  <a href="<?= BASEURL ?>/pageviews/<?= ($data['dataView']['jenis_views'] === 'Berita') ? '' : 'artikel' ?>" class="btn btn-secondary mt-3 mb-3"><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
</form>