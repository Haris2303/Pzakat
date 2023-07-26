<div class="container mt-5">

  <div class="row justify-content-center">
    <div class="col-lg-4 border-bottom shadow-lg py-5 px-4">

      <div class="mb-4 text-center">
        <h3 class="text-dark">Lupa Password?</h3>
        <hr class="border border-warning" width="100">
      </div>

      <?php Flasher::flash() ?>
      <form id="demo-form" action="<?= BASEURL ?>/login/aksi_reset_password" method="POST" class="form-group">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email..." autocomplete="off" required oninvalid="this.setCustomValidity('Enter Username Here')" oninput="this.setCustomValidity('')">
        </div>
        <div class="mb-3">
          <button type="submit" id="btn" class="btn btn-dark form-control">Kirim</button>
        </div>
      </form>
      <div class="mt-2 text-center">
        <a href="<?= BASEURL ?>/login" class="text-secondary">Kembali Login</a>
      </div>

    </div>
  </div>

</div>