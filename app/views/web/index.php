<section id="beranda" class="mt-5">
  <div class="container">
    <div class="flex flex-wrap">
      <div class="w-full self-center content">

        <!-- Slider main container -->
        <div class="swiper rounded-lg">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <?php foreach ($data['dataBanner'] as $item) : ?>
              <div class="swiper-slide">
                <img src="<?= BASEURL ?>/img/banner/<?= $item['gambar'] ?>" alt="" class="h-[200px] img-slide">
              </div>
            <?php endforeach ?>
          </div>
          <!-- pagination -->
          <div class="swiper-pagination"></div>

          <!-- navigation buttons -->
          <div class="swiper-button-prev bg-white rounded-full w-8 h-8 sm:w-10 sm:h-10 text-darkgray"></div>
          <div class="swiper-button-next bg-white rounded-full w-8 h-8 sm:w-10 sm:h-10 text-darkgray"></div>
        </div>
        <!-- end slider -->

        <!-- box program -->
        <div class="flex justify-center mt-1">
          <div class="bg-darkgray box-program">
            <div class="box-program-item border-b border-lightgray md:border-none">
              <span class="block text-xs">Program Donasi</span>
              <span class="font-bold lg:text-2xl"><?= $data['jumlahProgram'] ?></span>
            </div>
            <div class="box-program-item border-b border-lightgray md:border-none">
              <span class="block text-xs">Total Dana Terkumpul</span>
              <?php
              $dana = 0;
              foreach ($data['danaTerkumpul'] as $item) {
                $dana += filter_var($item['total_pemasukkan'], FILTER_VALIDATE_INT);
              }
              ?>
              <span class="font-bold lg:text-2xl">Rp <?= number_format($dana, 0, ',', '.') ?></span>
            </div>
            <div class="box-program-item">
              <span class="block text-xs">Donatur Terdaftar</span>
              <span class="font-bold lg:text-2xl">102341</span>
            </div>
          </div>
        </div>
        <!-- end box program -->


        <!-- program donasi -->
        <section id="program-donasi">
          <div class="title">
            <?= Flasher::flash() ?>
            <h3 class="text-title">Salurkan donasimu disini</h3>
            <span class="text-sm text-lightgray mt-2 inline-block">Silahkan pilih program donasi yang anda inginkan</span>
          </div>

          <!-- Kategori program -->
          <div class="w-full flex gap-2 md:gap-5 text-center mt-10 text-sm program-kategori">
            <?php foreach ($data['programNameAktif'] as $item) : ?>
              <a class="w-1/3 bg-lightgreen py-2 hover:bg-green hover:text-white transition-300 shadow-md text-darkgreen hover:cursor-pointer" data-name="<?= $item['nama_kategoriprogram'] ?>"><?= $item['nama_kategoriprogram'] ?></a>
            <?php endforeach ?>
          </div>

          <!-- program, use javascript in app.js -->
          <div class="w-full flex gap-5 flex-col lg:flex-row md:gap-5 mt-5 hover:shadow-lg transition-500 text-sm program"></div>

          <a href="<?= BASEURL ?>/programs">
            <div class="w-40 m-auto">
              <button class="mt-10 btn btn-lightgreen">Lihat Semua</button>
            </div>
          </a>
        </section>
        <!-- end program donasi -->

      </div>
    </div>
  </div>


  <!-- konsultasi -->
  <div class="py-20 w-full bg-darkgray mt-20">
    <div class="container">
      <div class="content text-center">
        <h3 class="font-medium text-lightgreen text-3xl mb-2">Masih Bingung Berzakat?</h3>
        <p class="text-green text-md">Anda dapat menekan tombol dibawah ini</p>
        <div class="flex justify-center mt-5 md:gap-5 gap-2 md:text-md flex-wrap">
          <div class="sm:w-36 w-32">
            <button class="btn btn-lightgreen">Konsultasi</button>
          </div>
          <a href="<?= BASEURL ?>/perhitunganzakat">
            <div class="sm:w-36 w-32">
              <button class="btn btn-lightgreen">Zakat Sekarang</button>
            </div>
          </a>
          <div class="sm:w-36 w-32">
            <button class="btn btn-lightgreen">Konfirmasi Zakat</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end konsultasi -->


  <!-- berita -->
  <div class="container">
    <div class="content">
      <section id="program-donasi">
        <div class="title">
          <h3 class="text-title">Berita Terbaru</h3>
          <span class="text-sm text-lightgray mt-2 inline-block">Info terkini saat ini</span>
        </div>

        <div class="w-full flex gap-5 flex-col lg:flex-row md:gap-5 mt-5 text-sm">

          <?php foreach ($data['dataBerita'] as $item) : ?>
            <div class="lg:w-1/3 shadow-md">
              <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>">
                <img src="<?= BASEURL ?>/img/views/<?= $item['gambar'] ?>" alt="" class="lg:h-48 h-64 w-full">
              </a>
              <div class="px-4 my-4 flex flex-col gap-1">
                <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>">
                  <h4 class="text-lg text-darkgray"><?= $item['judul'] ?></h4>
                </a>

                <!-- date and time -->
                <div class="flex text-xs text-darkgreen gap-2">
                  <div class="date flex gap-1">
                    <logo><svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" class="bi bi-calendar3 fill-darkgreen" viewBox="0 0 16 16">
                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                      </svg></logo>
                    <text><?= explode(' ', $item['datetime'])[0] ?></text>
                  </div>
                  <div class="time flex gap-1">
                    <logo><svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                      </svg></logo>
                    <text><?= explode(' ', $item['datetime'])[1] ?></text>
                  </div>
                </div>

                <div class="flex justify-between flex-wrap text-md max-h-20 overflow-hidden">
                  <p class="font-light text-lightgray leading-6">
                    <?= $item['content'] ?>
                  </p>
                </div>
                <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>">
                  <button class="btn btn-green">Lihat Selengkapnya...</button>
                </a>
              </div>
            </div>
          <?php endforeach ?>
        </div>

        <a href="<?= BASEURL ?>/page/news">
          <div class="w-40 m-auto">
            <button class="mt-10 btn btn-lightgreen">Berita lainnya</button>
          </div>
        </a>
      </section>
    </div>
  </div>
  <!-- end berita -->


  <!-- artkel -->
  <div class="container mt-20">
    <div class="content">
      <div class="w-full flex flex-wrap gap-5 justify-center">

        <div class="lg:w-1/2 w-full relative">
          <p class="text-sm font-bold text-darkgray block sm:-mb-0">Video</p>
          <iframe class="w-full aspect-video" src="<?= $data['src_video'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <div class="flex flex-col lg:w-1/3 w-full">
          <span class="text-darkgray text-sm font-bold">Artikel</span>
          <div class="flex gap-5 flex-col justify-center mt-2">

            <?php foreach ($data['dataArtikel'] as $item) : ?>

              <div class="flex gap-3">
                <div class="w-20">
                  <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>">
                    <img src="<?= BASEURL ?>/img/views/<?= $item['gambar'] ?>" alt="" class="object-cover w-full h-full">
                  </a>
                </div>
                <div class="flex-1 flex-col justify-evenly md:w-full lg:w-80">
                  <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>">
                    <div class="text-sm font-normal text-darkgray">
                      <?= $item['judul'] ?>
                    </div>
                  </a>
                  <span class="text-xs text-lightgray"><?= explode(' ', $item['datetime'])[0] ?></span>
                </div>
              </div>

            <?php endforeach ?>

          </div>

          <a href="<?= BASEURL ?>/page/artikel">
            <div class="w-40 m-auto">
              <button class="mt-10 btn btn-lightgreen">Artikel lainnya</button>
            </div>
          </a>

        </div>
      </div>
    </div>
  </div>
  <!-- end artikel -->


  <!-- Pilar -->
  <div class="container mt-24">
    <div class="content">

      <div class="title">
        <h3 class="text-title">6 Pilar Program Lazismu</h3>
        <span class="text-sm text-lightgray mt-2 inline-block">Mari kita dukung program-program yang dilaksanakan oleh Lazismu</span>
      </div>

      <div class="flex flex-wrap justify-evenly center mt-10 sm:gap-y-20 gap-y-10">
        <a href="" class="lg:w-1/3 sm:w-1/2 w-full">
          <div class="flex flex-col gap-3 text-center text-sm shadow-md rounded-lg mx-3 p-5">
            <div class="w-14 h-14 flex justify-center items-center bg-lightgreen m-auto rounded-md shadow-md">
              <i class="fas fa-solid fa-graduation-cap text-darkgreen text-2xl"></i>
            </div>
            <span class="text-darkgray">Pendidikan</span>
            <p class="text-lightgray">Program meningkatkan mutu SDM dengan menjalankan berbagai program di bidang pendidikan berupa pemenuhan sarana dan biaya pendidikan</p>
          </div>
        </a>

        <a href="" class="lg:w-1/3 sm:w-1/2 w-full">
          <div class="flex flex-col gap-3 text-center text-sm shadow-md rounded-lg mx-3 p-5">
            <div class="w-14 h-14 bg-lightgreen m-auto rounded-md shadow-md flex justify-center items-center">
              <i class="fas fa-solid fa-notes-medical text-darkgreen text-2xl"></i>
            </div>
            <span class="text-darkgray">Kesehatan</span>
            <p class="text-lightgray">Program Lazismu yang berfokus pada pemenuhan hak-hak mustahik untuk mendapatkan kehidupan yang berkualitas melalui layanan kesehatan atau prokes</p>
          </div>
        </a>

        <a href="" class="lg:w-1/3 sm:w-1/2 w-full">
          <div class="flex flex-col gap-3 text-center text-sm shadow-md rounded-lg mx-3 p-5">
            <div class="w-14 h-14 bg-lightgreen m-auto rounded-md shadow-md flex justify-center items-center">
              <i class="fas fa-solid fa-chart-line text-darkgreen text-2xl"></i>
            </div>
            <span class="text-darkgray">Ekonomi</span>
            <p class="text-lightgray">Program peningkatan kesejahteraan penerima manfaat dana Zakat dan Donasi lainnya dengan pola pemberdayaan maupun pelatihan-pelatihan wirausaha</p>
          </div>
        </a>

        <a href="" class="lg:w-1/3 sm:w-1/2 w-full">
          <div class="flex flex-col gap-3 text-center text-sm shadow-md rounded-lg mx-3 p-5">
            <div class="w-14 h-14 bg-lightgreen m-auto rounded-md shadow-md flex justify-center items-center">
              <i class="fas fa-solid fa-people-carry text-darkgreen text-2xl"></i>
            </div>
            <span class="text-darkgray">Kemanusiaan</span>
            <p class="text-lightgray">Penanganan masalah sosial yang timbul akibat ekses external terhadapa kehidupan mustahik, seperti bantuan bencana, pendampingan manula dan kegiatan karikatif</p>
          </div>
        </a>

        <a href="" class="lg:w-1/3 sm:w-1/2 w-full">
          <div class="flex flex-col gap-3 text-center text-sm shadow-md rounded-lg mx-3 p-5">
            <div class="w-14 h-14 bg-lightgreen m-auto rounded-md shadow-md flex justify-center items-center">
              <i class="fas fa-solid fa-stream text-darkgreen text-2xl"></i>
            </div>
            <span class="text-darkgray">Sosial Dakwah</span>
            <p class="text-lightgray">Pilar yang berfungsi menguatkan dan pemenuhan kebutuhan untuk kegiatan dakwah dengan tujuan kemandirian para da'i dan institusi dakwah</p>
          </div>
        </a>

        <a href="" class="lg:w-1/3 sm:w-1/2 w-full">
          <div class="flex flex-col gap-3 text-center text-sm shadow-md rounded-lg mx-3 p-5">
            <div class="w-14 h-14 bg-lightgreen m-auto rounded-md shadow-md flex justify-center items-center">
              <i class="fas fa-solid fa-dove text-darkgreen text-2xl"></i>
            </div>
            <span class="text-darkgray">Lingkungan</span>
            <p class="text-lightgray">Sumbangsih Lazismu unutk peningkatan kualitas lingkungan bagi kehidupan masyarakat dan ekosistem yang lebih baik sehingga bisa menjaga keseimbangan alam</p>
          </div>
        </a>
      </div>

    </div>
  </div>
  <!-- end pilar -->


  <!-- laporan -->
  <div class="w-full bg-darkgray mt-20">
    <div class="container p-14">
      <div class="content">
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide">
              <div class="flex lg:flex-nowrap flex-wrap gap-10 px-5">
                <div class="lg:w-1/2">
                  <a href="">
                    <img src="<?= BASEURL ?>/img/banner/banner.jpg" alt="" class="w-full h-full rounded-lg">
                  </a>
                </div>
                <div class="lg:w-1/2 relative">
                  <span class="absolute bg-lightgreen text-darkgreen text-sm rounded-lg block px-3">Laporan</span>
                  <div class="flex flex-col justify-center gap-5 h-full mt-5">
                    <div class="font-semibold text-white">
                      <h3>Laporan keuangan tahun ini boss</h3>
                    </div>
                    <div class="text-sm text-lightgreen">
                      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, quasi aliquam? Enim in ex dolores perferendis numquam architecto exercitationem! Soluta?</p>
                    </div>
                    <a href="">
                      <div class="w-40">
                        <button class="btn bg-green text-darkgreen">Detail</button>
                      </div>
                    </a>
                  </div>
                </div>
              </div>

            </div>
            <!-- <div class="swiper-slide">
              <img src="<?= BASEURL ?>/img/banner/2.jpeg" alt="" class="h-[200px] img-slide">
            </div>
            <div class="swiper-slide">
              <img src="<?= BASEURL ?>/img/banner/3.jpeg" alt="" class="h-[200px] img-slide">
            </div> -->
          </div>
          <!-- pagination -->
          <div class="swiper-pagination"></div>


          <!-- navigation buttons -->
          <div class="swiper-button-prev bg-white rounded-full w-8 h-8 sm:w-10 sm:h-10 text-darkgray"></div>
          <div class="swiper-button-next bg-white rounded-full w-8 h-8 sm:w-10 sm:h-10 text-darkgray"></div>
        </div>
        <!-- end slider -->
      </div>

      <!-- button -->
      <div class="w-40 m-auto">
        <button class="mt-10 btn btn-lightgreen">Lihat Semua</button>
      </div>
    </div>
  </div>
  <!-- end laporan -->


</section>