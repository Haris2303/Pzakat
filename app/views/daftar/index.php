<div class="container mt-3">

  <div class="row justify-content-center">
    <div class="col-lg-4 border-bottom shadow-lg py-5 px-4">
      <div class="mb-4 text-center">
        <h3 class="text-dark">Daftar</h3>
        <hr class="border border-warning" width="100">
      </div>

      <?php Flasher::flash() ?>

      <form action="<?= BASEURL ?>/daftar/aksi_daftar_muzakki" method="POST" class="form-group">
        <div class="mb-3">
          <label for="nama" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama" name="name" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email" placeholder="example@gmail.com" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <label for="nohop" class="form-label">No Handphone</label>
          <input type="tel" class="form-control" name="nohp" placeholder="No HP" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
        </div>
        <div class="mb-4">
          <label for="passwordConfirm" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="passwordConfirm" name="passConfirm" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <button type="submit" class="btn btn-secondary form-control">Daftar</button>
        </div>
      </form>

      <div class="text-center">
        <a href="<?php echo BASEURL ?>/login" class="text-dark">Sudah punya akun!</a>
      </div>

    </div>
  </div>
</div>