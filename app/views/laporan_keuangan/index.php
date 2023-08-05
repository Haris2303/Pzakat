<div class="container">
  <div class="content">
    <div class="title mb-5">
      <h3 class="text-title">Laporan Keuangan</h3>
      <span class="text-sm text-lightgray mt-2 inline-block">Laporan Keuangan Lazismu Unamin</span>
    </div>

    <div class="flex">
      <div class="w-full flex flex-col gap-y-5 flex-wrap lg:flex-row text-sm">
        <?php foreach ($data['laporan'] as $item) : ?>
  
          <div class="lg:w-1/3 px-3">
            <div class="shadow-lg pb-1">
              <a href="<?= $item['link'] ?>">
                <img src="<?= BASEURL ?>/img/laporan/keuangan.jpg" alt="" class="lg:h-48 h-64 w-full">
              </a>
              <div class="px-4 my-4 flex flex-col gap-1">
                <a href="<?= $item['link'] ?>">
                  <h4 class="text-lightgray text-sm">Laporan Keuangan Lazismu Unamin Tahun <?= $item['tahun'] ?></h4>
                </a>

                <div class="flex justify-between flex-wrap max-h-20 overflow-hidden">
                  <p class="text-lg font-light text-darkgray leading-6">
                    <?= $item['keterangan'] ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
  
        <?php endforeach ?>
      </div>
    </div>
    <?php Pagination::view(5) ?>
  </div>
</div>