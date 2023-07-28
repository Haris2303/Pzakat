<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 border-bottom shadow-sm py-3 px-3 d-flex gap-3">
            <img src="<?= BASEURL ?>/img/program/<?= $data['dataProgram']['gambar'] ?>" alt="gambar program" width="100">
            <div>
                <p class="px-3">Anda akan berdonasi untuk program:</p>
                <h4 class="text-dark px-3"><?= $data['dataProgram']['nama_program'] ?></h4>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2 mb-5">
        <div class="col-lg-6 border-bottom shadow-lg py-4 px-3">
            <form action="<?= BASEURL ?>/transaksi/aksi_tambah_donatur" method="POST">
                <input type="hidden" name="slug_program" value="<?= $data['dataProgram']['slug'] ?>">
                <input type="hidden" name="key" value="<?= $data['dataKey'] . '_' . time() ?>">

                <!-- jika ada session username -->
                <?php if(isset($_SESSION['username'])): ?>
                    <?php 
                        // ambil id user
                        $id_user = $this->model('User_model')->getIdByUsername($_SESSION['username']);
                    ?>
                    <input type="hidden" name="id_user" value="<?= $id_user ?>">
                <?php endif ?>

                <div class="mb-3">
                    <label for="nominal-donasi">Nominal Donasi</label>
                    <div class="position-relative">
                        <p class="position-absolute mt-2 mx-3">Rp </p>
                        <!-- jika pembayaran adalah fidyah -->
                        <?php if($data['dataProgram']['jenis_pembayaran'] === 'fidyah'): ?>
                            <?php if(($data['qtyFidyah'] <= 0)): ?>
                                <?php header('Location: ' . BASEURL . '/transaksi/qty/' . $data['dataProgram']['jenis_pembayaran'] . '/' . $data['dataProgram']['slug']) ?>
                            <?php else: ?>
                                <input type="text" id="nominal-donasi" class="form-control px-5" name="nominal-donasi" value="<?= number_format($data['qtyFidyah'], 0, ',', '.') ?>" readonly>
                            <?php endif ?>
                        <!-- jika pembayaran adalah qurban -->
                        <?php elseif((!is_null($data['dataProgram']['nominal_bayar'])) && ($data['dataProgram']['nominal_bayar'] !== 0)): ?>
                            <input type="text" id="nominal-donasi" class="form-control px-5" name="nominal-donasi" placeholder="0" value="<?= number_format($data['dataProgram']['nominal_bayar'], 0, ',', '.') ?>" readonly>
                        <!-- Jika pembayaran bukan fidyah dan qurban -->
                        <?php else: ?>
                            <input type="text" id="nominal-donasi" class="form-control px-5" name="nominal-donasi" placeholder="0" onkeydown="return currency(event)">
                        <?php endif ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bank">Pilih Bank</label>
                    <select name="bank" id="bank" class="form-control">
                        <?php foreach ($data['dataNorek'] as $item): ?>
                            <option value="<?= $item['id_norek'] ?>"><?= $item['nama_bank'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama-lengkap">Nama Lengkap</label>
                    <input type="text" name="nama-lengkap" id="nama-lengkap" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="nohp">Nomor Telepon</label>
                    <input type="tel" name="nohp" id="nohp" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="pesan">Pesan</label>
                    <textarea name="pesan" id="pesan" class="form-control" rows="5" placeholder="tuliskan pesan atau doa"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning form-control">Selanjutnya</button>
                </div>
            </form>
        </div>
    </div>
</div>