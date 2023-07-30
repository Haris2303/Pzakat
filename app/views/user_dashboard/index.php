<?php 
$dana = 0;
foreach ($data['dana'] as $d) {
    $dana += $d['jumlah_pembayaran'];
}
?>
<div class="lg:mt-20 mt-10 w-full">
    <h2 class="font-bold text-xl text-darkgray mb-2">Dashboard</h2>
    <p class="text-sm text-lightgray">Jumlah donasi dan dana yang telah dikeluar untuk berdonasi</p>

    <div class="flex gap-5 mt-4 sm:flex-row flex-col">
        <div class="sm:w-1/2 flex items-center gap-4 p-5 shadow-md">
            <div class="w-12 h-12 text-center leading-[48px] text-2xl text-white bg-green rounded-lg">
                <i class="fas fa-solid fa-hand-holding-heart"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-sm text-lightgray">Jumlah Donasi</span>
                <span class="text-darkgray text-lg"><?= $data['jumlah_donasi'] ?></span>
            </div>
        </div>
        <div class="sm:w-1/2 flex items-center gap-4 p-5 shadow-md">
            <div class="w-12 h-12 text-center leading-[48px] text-2xl text-white bg-green rounded-lg">
                <i class="fas fa-solid fa-dollar-sign"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-sm text-lightgray">Dana Dikeluarkan</span>
                <span class="text-darkgray text-lg">Rp <?= number_format($dana, 0, ',', '.') ?></span>
            </div>
        </div>
    </div>

</div>




<!-- Close div container -->
</div>
<!-- close div content -->
</div>
