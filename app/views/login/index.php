<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
<script>
  let verify = '';
  const verifyCallback = (response) => {
    verify = response
  }
  var onloadCallback = function() {
    grecaptcha.render('recaptcha-response', {
      'callback': verifyCallback
    });
  };
  const validasiCaptcha = () => {
    if (verify === '') {
      alert('Enter Captcha');
      return false;
    }
  }
</script>

<div class="container mt-5">

  <div class="row justify-content-center">
    <div class="col-lg-4 border-bottom shadow-lg py-5 px-4">

      <div class="mb-4 text-center">
        <h3 class="text-dark">Login</h3>
        <hr class="border border-warning" width="100">
      </div>

      <?php Flasher::flash() ?>
      <form id="demo-form" action="<?= BASEURL ?>/login/aksi_login" method="POST" class="form-group">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" name="username" id="username" class="form-control" placeholder="username" autocomplete="off" required oninvalid="this.setCustomValidity('Enter Username Here')" oninput="this.setCustomValidity('')">
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Password</label>
          <input type="password" id="password" class="form-control" name="password" placeholder="password" autocomplete="off" required oninvalid="this.setCustomValidity('Enter Password Here')" oninput="this.setCustomValidity('')">
        </div>
        <div class="mb-3">
          <div id="recaptcha-response" class="g-recaptcha" data-sitekey="6LcRtVUmAAAAACdQriPKhPWS8gmabD9dyVrl_Z7w"></div>
          <small>This site is protected by reCAPTCHA and the Google
            <a href="https://policies.google.com/privacy">Privacy Policy</a> and
            <a href="https://policies.google.com/terms">Terms of Service</a> apply.
          </small>
        </div>
        <div class="mb-3">
          <button type="submit" id="btn" class="btn btn-dark form-control" onclick="return validasiCaptcha()">Login</button>
        </div>
      </form>
      <div class="mt-3 text-center">
        <a href="<?= BASEURL ?>/daftar" class="text-secondary">Belum Punya Akun?</a>
      </div>

    </div>
  </div>

</div>