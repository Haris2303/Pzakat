<div class="container mt-5">

  <div class="row justify-content-center">
    <div class="col-lg-4 border-bottom shadow-lg py-5 px-4">

      <div class="mb-4 text-center">
        <h3 class="text-dark">Ubah Password</h3>
        <hr class="border border-warning" width="100">
      </div>

      <?php Flasher::flash() ?>
      <form id="demo-form" action="<?= BASEURL ?>/login/aksi_ubah_password" method="POST" class="form-group">
        <input type="hidden" name="token" value="<?= $data['token'] ?>">
        <div class="mb-3">
          <label for="password1" class="form-label">Password Baru</label>
          <input type="password" name="password_baru" id="password1" class="form-control" placeholder="Enter your password..." autocomplete="off" required oninvalid="this.setCustomValidity('Enter Username Here')" oninput="this.setCustomValidity('')">
        </div>
        <div class="mb-3">
          <label for="password2" class="form-label">Password Konfirmasi</label>
          <input type="password" name="password_konfirmasi" id="password2" class="form-control" placeholder="Enter your confirmation password..." autocomplete="off" required oninvalid="this.setCustomValidity('Enter Username Here')" oninput="this.setCustomValidity('')">
        </div>
        <div class="mb-3">
          <button type="submit" id="btn" class="btn btn-dark form-control">Ubah</button>
        </div>
      </form>
      <div class="mt-2 text-center">
        <a href="<?= BASEURL ?>/login" class="text-secondary">Kembali Login</a>
      </div>

    </div>
  </div>

</div>