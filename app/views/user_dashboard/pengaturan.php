<div class="lg:mt-20 mt-10 w-full">
    <h2 class="font-bold text-xl text-darkgray mb-2">Pengaturan</h2>
    <?php Flasher::flash() ?>
    <div class="flex gap-5 md:flex-row flex-col">
        <div class="md:w-1/2 shadow-lg p-5 rounded-lg">
            <p class="text-lg text-darkgreen flex items-center gap-2"><i class="fas fa-solid fa-user-circle text-xl"></i> <span>Profil</span></p>
            <form action="<?= BASEURL ?>/user_dashboard/aksi_ubah_profil" method="post" class="mt-3">
                <div class="mb-5">
                    <label for="nama" class="text-lightgray">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-input" value="<?= $data['muzakki']['nama'] ?>" placeholder="nama lengkap" autocomplete="off">
                </div>
                <div class="mb-5">
                    <label for="username" class="text-lightgray">Username</label>
                    <input type="text" name="username" id="username" class="form-input" value="<?= $data['muzakki']['username'] ?>" placeholder="username" autocomplete="off">
                </div>
                <div class="mb-5">
                    <label for="nohp" class="text-lightgray">Nomor Telepon</label>
                    <input type="text" name="nohp" id="nohp" class="form-input" value="<?= $data['muzakki']['nohp'] ?>" placeholder="08xxxxxxxxx" onkeydown="return countInput(event)" autocomplete="off">
                </div>
                <div class="mb-3 float-right md:float-left">
                    <button class="py-2 px-4 bg-green text-white hover:bg-darkgreen rounded-lg transition-300"><i class="fas fa-save mr-2"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    
        <div class="md:w-1/2 shadow-lg p-5 rounded-lg">
            <p class="text-lg text-darkgreen flex items-center gap-2"><i class="fas fa-solid fa-key text-xl"></i> <span>Ubah Password</span></p>
            <form action="<?= BASEURL ?>/user_dashboard/aksi_ubah_password" method="post" class="mt-3">
                <div class="mb-5">
                    <label for="password" class="text-lightgray">Password</label>
                    <input type="password" name="password" id="password" class="form-input" placeholder="old password" autocomplete="off" required>
                </div>
                <div class="mb-5">
                    <label for="password_baru" class="text-lightgray">Password Baru</label>
                    <input type="password" name="password_baru" id="password_baru" class="form-input" placeholder="new password" autocomplete="off" required>
                </div>
                <div class="mb-5">
                    <label for="password_konfirmasi" class="text-lightgray">Konfirmasi Password</label>
                    <input type="password" name="password_konfirmasi" id="password_konfirmasi" class="form-input" placeholder="confirmation" autocomplete="off" required>
                </div>
                <div class="mb-3 flex justify-end">
                    <button class="py-2 px-4 bg-green text-white hover:bg-darkgreen rounded-lg transition-300"><i class="fas fa-save mr-2"></i> Simpan Password</button>
                </div>
            </form>
        </div>
    </div>

</div>


<!-- Close div container -->
</div>
<!-- close div content -->
</div>

<script src="<?= BASEURL ?>/js/util/script.js"></script>