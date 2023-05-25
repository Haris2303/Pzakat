<div class="container mt-5">

  <div class="row justify-content-center">
    <div class="col-lg-4 border-bottom shadow-lg py-5 px-4">

      <div class="mb-4 text-center">
        <h3 class="text-dark">Login</h3>
        <hr class="border border-warning" width="100">
      </div>

      <?php Flasher::flash() ?>
      <form action="<?= BASEURL ?>/login/aksi_login" method="POST" class="form-group">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="username" autocomplete="off">
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" name="password" placeholder="password" autocomplete="off">
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-dark form-control">Login</button>
        </div>
      </form>
      <div class="mt-3 text-center">
        <a href="<?= BASEURL ?>/daftar" class="text-secondary">Belum Punya Akun?</a>
      </div>

    </div>
  </div>

</div>