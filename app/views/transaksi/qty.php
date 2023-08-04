<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 border-bottom shadow-sm py-3 px-3 d-flex gap-3">
            <img src="<?= BASEURL ?>/img/program/<?= $data['dataProgram']['gambar'] ?>" alt="gambar program" width="100">
            <div>
                <p class="px-3 h6" style="font-size: 14px">Anda akan berdonasi untuk program:</p>
                <h5 class="text-dark px-3"><?= $data['dataProgram']['deskripsi_program'] ?></h5>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2 mb-5">
        <div class="col-lg-6 border-bottom shadow-lg py-4 px-3">
            <form action="<?= BASEURL ?>/transaksi/<?= $data['dataProgram']['slug'] ?>/" method="POST">
                <div class="mb-3">
                    <h6><strong>Fidyah / Hari: Rp 45.000</strong></h6>
                </div>
                <div class="mb-3">
                    <label for="jumlah-hari" style="font-size: 14px">Jumlah Hari</label>
                    <div class="position-relative">
                        <input type="text" name="qtyfidyah" id="jumlah-hari" class="form-control" placeholder="Contoh: 1" autocomplete="off" onkeydown="return calcFidyah(event)">
                    </div>
                </div>
                <div class="mb-3">
                    <a href="<?= BASEURL ?>/transaksi/<?= $data['dataProgram']['slug'] ?>/" class="btn btn-warning form-control next-btn">Selanjutnya</a>
                </div>
            </form>
        </div>
    </div>
</div>