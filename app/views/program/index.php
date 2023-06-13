<div class="container">
    <div class="content">

        <!-- content img and deksripsi tunai -->
        <div class="flex gap-5 mt-5">
            <div class="w-full">
                <img src="<?= BASEURL ?>/img/program/<?= $data['dataProgram']['gambar'] ?>" alt="gambar program">
            </div>
            <div class="w-2/4 flex flex-col justify-between">
                <div>
                    <span class="text-lightgray text-xs"><?= $data['dataProgram']['nama_program'] ?></span>
                    <p class="text-darkgray text-md font-medium"><?= $data['dataProgram']['deskripsi_program'] ?></p>
                </div>
                <div>
                    <p class="font-medium text-darkgray text-2xl">Rp. <?= $data['dataProgram']['total_dana'] ?></p>
                    <span class="text-lightgray text-sm">Dana Terus Dikumpul</span>
                    <div class="flex text-lightgray justify-between text-xs pt-2 mb-3 border-t mt-2">
                        <span><span class="text-darkgray text-sm font-medium"><?= $data['dataProgram']['jumlah_donatur'] ?></span> Donatur</span>
                        <!-- <span>Hari Lagi</span> -->
                    </div>
                    <div class="flex">
                        <a href="<?= BASEURL ?>/transaksi/<?= ($data['dataProgram']['jenis_pembayaran'] === 'uang') ? $data['dataProgram']['slug'] : 'qty/fidyah/'.$data['dataProgram']['slug'] ?>" class="btn btn-lightgreen">Tunaikan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <ul class="flex gap-10 mt-20 border-y py-5 text-lightgray text-sm">
            <li class="border-b-2 border-lightgreen hover:cursor-pointer">Deskripsi</li>
            <li class="border-b-2 hover:cursor-pointer">Donatur</li>
        </ul>

        <div class="w-2/3 mt-9 text-lightgray text-sm">
            <?= $data['dataProgram']['content'] ?>
        </div>

    </div>
</div>