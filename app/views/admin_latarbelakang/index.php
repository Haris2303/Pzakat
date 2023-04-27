<div class="container-fluid">
  <h2 class="h3">Latar Belakang</h2>
  <?= Flasher::flash() ?>
  <form action="<?= BASEURL ?>/admin_latarbelakang/change" method="post" class="mt-3">
    <textarea name="textarea" id="default"><?= $data['latar-belakang']['content']?></textarea>
    <button type="submit" class="btn btn-primary mt-3">Change</button>
  </form>
</div>