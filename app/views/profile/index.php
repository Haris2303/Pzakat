<h3 class="h2">Profil Saya</h3>

<div class="row mt-4">
    <div class="col-md-6">
        <?php Flasher::flash() ?>
        <form action="<?= BASEURL ?>/profile/aksi_ubah_profil_amil" method="post">
            <div class="mb-3">
                <label for="nama-lengkap" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_amil" id="nama-lengkap" class="form-control" value="<?= $data['dataProfile']['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" value="<?= $data['dataProfile']['email'] ?>">
            </div>
            <div class="mb-3">
                <label for="nohp" class="form-label">Nomor Handphone</label>
                <input type="text" name="nohp" id="nohp" class="form-control" value="<?= $data['dataProfile']['nohp'] ?>">
            </div>
            <div class="mb-3">
                <label for="mesjid" class="form-label">Masjid</label>
                <select name="id_mesjid" id="mesjid" class="form-control">
                    <?php foreach($data['dataMasjid'] as $item): ?>
                        <option value="<?= $item['id_mesjid'] ?>" <?= ($item['id_mesjid'] === $data['dataProfile']['id_mesjid']) ? 'selected' : '' ?>><?= $item['nama_mesjid'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" rows="3"><?= $data['dataProfile']['alamat'] ?></textarea>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-save mr-1"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>