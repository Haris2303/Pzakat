<h3 class="h2">Profil Saya</h3>

<div class="row mt-4">
    <div class="col-md-6">
        <?php Flasher::flash() ?>
        <form action="<?= BASEURL ?>/profile/aksi_ubah_profil_admin" method="post">
            <div class="mb-3">
                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama-lengkap" class="form-control" value="<?= $data['admin']['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= $data['admin']['username'] ?>">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>