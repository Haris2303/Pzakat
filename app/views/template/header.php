<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zakat | <?= $data['judul'] ?></title>

  <!-- icon shorcut -->
  <link rel="shortcut icon" href="<?= BASEURL ?>/img/logo/logo.png" type="image/x-icon">
  <!-- cdn swiperjs -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <!-- my css -->
  <link rel="stylesheet" href="<?= BASEURL ?>/css/app.css">
</head>

<body>

  <navbar class="relative top-0 left-0 w-full flex items-center z-10">
    <div class="container">
      <div class="content flex item-center justify-between relative">
        <div class="logo">
          <a href="<?= BASEURL ?>/" class="font-bold text-2xl text-green block py-6">Yuk Zakat</a>
        </div>

        <div class="flex items-center px-4">
          <button id="hamburger" name="hamburger" class="block absolute right-4 md:hidden">
            <span class="hamburger-line bg-darkgray transition-500 origin-top-left"></span>
            <span class="hamburger-line bg-darkgray transition-500"></span>
            <span class="hamburger-line bg-darkgray transition-500 origin-bottom-left"></span>
          </button>

          <nav id="nav-menu" class="hidden absolute nav-menu">
            <ul class="block md:flex gap-10 items-center">
              <li class="group md:pb-0 pb-2">
                <a href="<?= BASEURL ?>" class="text-lightgray group-hover:text-green transition-300">Beranda</a>
              </li>
              <li class="md:pb-0 pb-2 dropmenu relative">

                <div class="btn-dropdown group">
                  <button class="text-lightgray group-hover:text-green transition-300">
                  <div class="flex items-center gap-1">
                    <div>Tentang Kami</div>
                    <div class="arrow">
                      <svg xmlns="http://www.w3.org/2000/svg" width="12" height="20" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                          <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                        </svg>
                    </div>
                  </div>  
                  </button>

                  <div class="md:mt-2 md:p-3 md:scale-0 md:group-hover:scale-110 md:h-auto h-0 overflow-hidden transition-500 dropdown-menu flex gap-1 flex-col md:absolute bg-white text-lightgray rounded-md w-52 md:shadow-md">
                    <a class="dropdown-item hover:text-green transition-300" href="<?= BASEURL ?>/latarbelakang">Latar Belakang</a>
                    <a class="dropdown-item hover:text-green transition-300" href="<?= BASEURL ?>/visimisi">Visi Misi dan Prinsip</a>
                    <a class="dropdown-item hover:text-green transition-300" href="#">Laporan Keuangan</a>
                  </div>
                </div>

              </li>
              <li class="group md:pb-0 pb-2">
                <a href="" class="text-lightgray group-hover:text-green transition-300">Berita</a>
              </li>
              <li class="group md:pb-0 pb-2">
                <a href="<?= BASEURL ?>/program" class="text-lightgray group-hover:text-green transition-300">Program</a>
              </li>
              <li class="group md:bg-green md:py-2 md:px-3 md:hover:bg-darkgreen transition-300 md:border-none border-t-2 md:-mr-8">
                <a href="<?= BASEURL ?>/login" class="md:text-white group-hover:text-lightgreen transition-300 text-green">Masuk</a>
              </li>
              <li class="group md:bg-green md:py-2 md:px-3 md:hover:bg-darkgreen transition-300 md:-mr-8">
                <a href="<?= BASEURL ?>/" class="md:text-white group-hover:text-lightgreen transition-300 text-green">Daftar</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </navbar>