<h3 class="h2">Pengaturan</h3>

<div class="row mt-5">
    <div class="col-md-6">
        <h4 class="h5 mb-3">Ubah Password</h4>
        <?php Flasher::flash() ?>
        <form action="<?= BASEURL ?>/settings/aksi_ubah_password" method="post">
            <div class="mb-3">
                <input type="password" name="password-lama" class="form-control" placeholder="Password Sebelumnya" autocomplete="off">
            </div>
            <div class="mb-3">
                <input type="password" name="password-baru" class="form-control" placeholder="Password Baru">
            </div>
            <div class="mb-3">
                <input type="password" name="password-konfirmasi" class="form-control" placeholder="Konfirmasi Password">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Simpan Password</button>
            </div>
        </form>
    </div>
</div>