<div class="container">
  <div class="content">
    <!-- program donasi -->
    <section id="program-donasi">
      <div class="title">
        <h3 class="text-title">Program tersedia</h3>
        <span class="text-sm text-lightgray mt-2 inline-block">Pilih dan salurkan donasi yang berarti untuk Anda dan mereka</span>
      </div>

      <?= Flasher::flash() ?>

      <div class="w-full flex text-center mt-10 text-sm">
        <?php foreach($data['dataJenisProgramAktif'] as $item): ?>
          <a href="<?= BASEURL ?>/programs/<?= strtolower($item['nama_kategoriprogram']) ?>" class="w-1/3 bg-lightgreen py-2 md:mx-3 mx-1 hover:bg-green hover:text-white transition-300 shadow-md"><?= $item['nama_kategoriprogram'] ?></a>
        <?php endforeach ?>
      </div>

      <div class="w-full flex gap-y-5 flex-wrap mt-5 text-sm">

      <?php foreach ($data['dataProgramDonasi'] as $item): ?>
        <div class="lg:w-1/3 sm:w-1/2 lg:px-3 px-2">
          <div class="shadow-md pb-3">
            <a href="<?= BASEURL ?>/program/<?= $item['slug'] ?>">
              <img src="<?= BASEURL ?>/img/program/<?= $item['gambar'] ?>" alt="" class="lg:h-48 object-cover sm:h-48 h-64 lg:w-full w-screen">
            </a>
            <div class="px-4 my-4 flex flex-col gap-1">
              <a href="<?= BASEURL ?>/program/<?= $item['slug'] ?>"><span class="category text-lightgray text-xs"><?= $item['jenis_program'] ?></span></a>
              <a href="<?= BASEURL ?>/program/<?= $item['slug'] ?>">
                <h4 class="text-md text-darkgray"><?= $item['nama_program'] ?></h4>
              </a>
              <span class="garis-progress my-1 after:w-8"></span>
              <div class="flex justify-between text-xs text-lightgray">
                <div>Donasi Terkumpul</div>
                <div>Donatur</div>
              </div>
              <div class="flex justify-between text-md text">
                <div class="font-bold text-darkgray">Rp <?= number_format($item['total_dana'], 0, ',', '.') ?></div>
                <div class="text-darkgray"><?= $item['jumlah_donatur'] ?></div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach ?>

      </div>

      <div class="w-40 m-auto">
        <button class="mt-10 btn btn-lightgreen">Lihat Lebih Banyak</button>
      </div>
    </section>
    <!-- end program donasi -->

  </div>
</div>
</div>