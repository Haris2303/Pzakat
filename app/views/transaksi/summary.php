<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-6 border-bottom shadow-sm py-3 px-3 d-flex gap-3">
            <div class="mb-3 m-auto text-center">
                <span>No Pembayaran</span>
                <h3 class="h3">KADS-2343214</h3>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2 mb-5">
        <div class="col-lg-6 border-bottom shadow-lg py-4 px-3">
            <div class="mb-3 border-bottom">
                <h4>Data Konfirmasi Donasi</h4>
            </div>
            <form action="<?= BASEURL ?>" method="POST">
                <div class="mb-3">
                    <label for="nominal-donasi">Nominal Donasi</label>
                    <div class="position-relative">
                        <p class="position-absolute mt-2 mx-3">Rp. </p>
                        <input type="text" id="nominal-donasi" class="form-control px-5" name="nominal-donasi fw-light" value="0" readonly>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bank">Transfer Ke</label>
                    <div class="border p-4">
                        <div class="row text-center">
                            <div class="col-lg-12">
                                <img src="<?= BASEURL ?>/img/logo-bri.png" alt="Gambar Bank" width="200">
                            </div>
                            <div class="col-lg-12 text-left">
                                <div class="row mt-4">
                                    <div class="col-lg-5">
                                        <span>Nama Tujuan Akun: </span>
                                        <span>Nomor Akun Tujuan: </span>
                                    </div>
                                    <div class="col-lg-7">
                                        <span class="d-block"><strong>Alimudin</strong></span>
                                        <span><strong>24513413341</strong></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="bukti" class="form-label">Upload Bukti Transfer</label>
                    <input type="file" name="gambar" id="bukti" class="form-control">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-warning form-control">Konfirmasi</button>
                </div>
            </form>
        </div>
    </div>
</div>