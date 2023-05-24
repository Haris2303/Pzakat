<h2 class="h3">Latar Belakang</h2>
<?= Flasher::flash() ?>
<form action="<?= BASEURL ?>/admin_latarbelakang/change" method="post" class="mt-3">
  <div class="mb-3">
    <label for="penulis" class="form-label">Dibuat oleh</label>
    <input type="text" name="username" id="penulis" class="form-control" value="<?= $_SESSION['username'] ?>">
  </div>
  <textarea name="textarea" id="default"><?= $data['latar-belakang']['content'] ?></textarea>
  <button type="submit" class="btn btn-primary mt-3">Change</button>
</form>