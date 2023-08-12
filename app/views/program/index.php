<div class="container">
    <div class="content">

        <!-- content img and deksripsi tunai -->
        <div class="flex md:flex-row flex-col gap-5 mt-5">
            <div class="w-full">
                <img src="<?= BASEURL ?>/img/program/<?= $data['dataProgram']['gambar'] ?>" alt="gambar program">
            </div>
            <div class="md:w-2/4 w-full flex flex-col justify-between">
                <div class="mb-10">
                    <span class="text-lightgray text-xs"><?= $data['dataProgram']['nama_program'] ?></span>
                    <p class="text-darkgray text-md font-medium"><?= $data['dataProgram']['deskripsi_program'] ?></p>
                    <?php if(($data['dataProgram']['nominal_bayar'] !== 0) && (!is_null($data['dataProgram']['nominal_bayar']))): ?>
                        <span class="text-lightgray text-md">Nominal yang harus dibayarkan: Rp <?= number_format($data['dataProgram']['nominal_bayar'], 0, ',', '.') ?></span>
                    <?php endif ?>
                </div>
                <div>
                    <p class="font-medium text-darkgray md:text-2xl text-xl">Rp <?= number_format($data['dataProgram']['total_dana'], 0, ',', '.') ?></p>
                    <span class="text-lightgray text-sm">Dana Terus Dikumpul</span>
                    <div class="flex text-lightgray justify-between text-xs pt-2 mb-3 border-t mt-2">
                        <span><span class="text-darkgray text-sm font-medium"><?= $data['dataProgram']['jumlah_donatur'] ?></span> Donatur</span>
                        <!-- <span>Hari Lagi</span> -->
                    </div>
                    <div class="flex">
                        <a href="<?= BASEURL ?>/transaksi/<?= ($data['dataProgram']['jenis_pembayaran'] !== 'fidyah') ? $data['dataProgram']['slug'] : 'qty/fidyah/'.$data['dataProgram']['slug'] ?>" class="btn btn-lightgreen">Tunaikan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="flex gap-10 mt-20 border-y py-5 text-lightgray text-sm">
            <li class="w-full">Content</li>
            <li class="w-2/3 lg:block hidden">Donatur</li>
        </ul>

        <div class="flex lg:flex-row flex-col mt-9 text-lightgray text-sm lg:gap-10 gap-20">
            <div class="w-full">
                <?= $data['dataProgram']['content'] ?>
            </div>
            <div class="lg:w-2/3">
                <?php foreach($data['donatur'] as $item): ?>
                <div class="flex gap-5 mb-5">
                    <img src="<?= BASEURL ?>/svg/undraw_profile.svg" alt="" width="50rem" class="rounded-full">
                    <div class="flex flex-col gap-1">
                        <span class="block font-bold"><?= $item['nama_donatur'] ?></span>
                        <span><?= $item['pesan'] ?></span>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>

    </div>
</div>