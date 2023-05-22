<h2 class="h3">Upload Blog Terkini</h2>
<?= Flasher::flash() ?>
<form action="<?= BASEURL ?>/pageviews/aksi_tambah_berita" method="post" class="mt-3" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="penulis" class="form-label">Penulis</label>
    <input type="text" name="username" id="penulis" class="form-control" value="<?= $_SESSION['username'] ?>" readonly>
  </div>
  <div class="mb-3">
    <label for="jenis-views" class="form-label">Jenis Blog</label>
    <input type="text" name="jenis_view" id="jenis-views" class="form-control" value="<?= $data['jenis_view'] ?>" readonly>
  </div>
  <div class="mb-3">
    <label for="judul" class="form-label">Judul</label>
    <input type="text" class="form-control" id="judul" name="judul" required autocomplete="off">
  </div>
  <div class="mb-3">
    <label for="gambar" class="form-label">Upload Gambar</label>
    <input type="file" class="form-control" id="gambar" name="gambar" required autocomplete="off">
  </div>
  <div class="mb-3">
    <label class="form-label">Isi Berita</label>
    <textarea name="content" id="default"></textarea>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Upload</button>
</form>