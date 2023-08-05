
<div class="container">
    <div class="content lg:flex lg:gap-10">
        <div class="lg:w-1/3 w-full shadow-slate-300 shadow-lg rounded-md">
            <div class="flex gap-3 p-3 mb-4">
                <div class="w-1/3">
                    <img src="<?= BASEURL ?>/svg/undraw_profile.svg" alt="Logo Profile" class="m-auto" width="80">
                </div>
                <div class="w-full flex flex-col justify-center">
                    <span class="text-darkgray"><?= $_SESSION['nama'] ?></span>
                    <span class="text-sm text-lightgray"><?= $_SESSION['username'] ?></span>
                </div>
            </div>

            <div class="flex flex-col gap-5 px-5 pb-5 text-lightgray">
                <a href="<?= BASEURL ?>/user_dashboard">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white <?= ($data['judul'] === 'User Dashboard') ? 'bg-green text-white' : '' ?>">
                        <i class="fas fa-home"></i>
                        <span class="text-sm">Dashboard</span>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/user_dashboard/donasi_pending">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white <?= ($data['judul'] === 'Menunggu Pembayaran') ? 'bg-green text-white' : '' ?>">
                        <i class="fas fa-spinner"></i>
                        <span class="text-sm">Menunggu Pembayaran</span>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/user_dashboard/donasi_konfirmasi">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white <?= ($data['judul'] === 'Konfirmasi Donasi') ? 'bg-green text-white' : '' ?>">
                        <i class="fas fa-donate"></i>
                        <span class="text-sm">Donasi Konfirmasi</span>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/user_dashboard/donasi_gagal">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white <?= ($data['judul'] === 'Konfirmasi Donasi') ? 'bg-green text-white' : '' ?>">
                        <i class="fas fa-times-circle"></i>
                        <span class="text-sm">Donasi Gagal</span>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/user_dashboard/donasi_sukses">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white <?= ($data['judul'] === 'Donasi Sukses') ? 'bg-green text-white' : '' ?>">
                        <i class="fas fa-solid fa-check-circle"></i>
                        <span class="text-sm">Donasi Sukses</span>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/user_dashboard/pengaturan">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white <?= ($data['judul'] === 'Pengaturan Akun') ? 'bg-green text-white' : '' ?>">
                        <i class="fas fa-wrench"></i>
                        <span class="text-sm">Pengaturan</span>
                    </div>
                </a>
                <a href="<?= BASEURL ?>/userlogout" onclick="return confirm('Apakah Anda ingin logout?')">
                    <div class="flex gap-3 items-center hover:bg-green p-3 cursor-pointer transition-300 rounded-lg hover:text-white">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="text-sm">Log out</span>
                    </div>
                </a>
            </div>
        </div>

