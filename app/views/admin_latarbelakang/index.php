<h2 class="h3">Latar Belakang</h2>
<?= Flasher::flash() ?>
<form action="<?= BASEURL ?>/admin_latarbelakang/change" method="post" class="mt-3">
  <div class="mb-3">
    <label for="penulis" class="form-label">Dibuat oleh</label>
    <input type="text" name="username" id="penulis" class="form-control" value="<?= $data['latar-belakang']['username'] ?>">
  </div>
  <textarea name="textarea" id="default"><?= $data['latar-belakang']['content'] ?></textarea>
  <div class="my-3">
    <span>Terakhir Dibuat: <?= $data['latar-belakang']['datetime'] ?></span>
  </div>
  <button type="submit" class="btn btn-primary mt-3 mb-3"><i class="fas fa-save"></i> Change</button>
</form>