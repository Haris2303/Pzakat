<h2 class="h3">Visi Misi</h2>
<?= Flasher::flash() ?>
<form action="<?= BASEURL ?>/admin_visimisi/change" method="post" class="mt-3">
  <textarea name="textarea" id="default"><?= $data['visimisi']['content'] ?></textarea>
  <button type="submit" class="btn btn-primary mt-3">Change</button>
</form>