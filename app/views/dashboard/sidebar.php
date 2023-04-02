<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | <?= $data['judul'] ?></title>
  <link rel="stylesheet" href="<?= BASEURL ?>/css/style.css">
</head>

<body>

  <!-- sidebar -->
  <div class="md:relative fixed right-0 left-0 top-0 bottom-0">

    <input type="checkbox" class="toggle-sidebar ml-5 top-3 absolute z-[999] w-8 h-8 opacity-0 cursor-pointer">
    <section class="sidebar h-full pb-[100%]">
      <div class="brand m-5 w-32">Yuk Zakat</div>
      <ul class="sidebar-menu text-white flex flex-col gap-1">

      <!-- Home -->
        <a href="<?= BASEURL ?>/dashboard">
          <li class="flex items-center gap-5 py-2 <?= ($data['judul'] === 'Halaman Dashboard') ? 'sidebar-active' : '' ?>">
            <i>
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
              </svg>
            </i>
            <span>Home</span>
          </li>
        </a>

        <!-- Amil -->
        <a href="<?= BASEURL ?>/amil">
        <li class="flex items-center gap-5 py-2 <?= ($data['judul'] === 'Amil') ? 'sidebar-active' : '' ?>">
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg>
          </i>
          <span>Amil</span>
        </li>
      </a>

      <!-- masjid -->
      <a href="<?= BASEURL ?>/masjid">
        <li class="flex items-center gap-5 py-2 <?= ($data['judul'] === 'Masjid') ? 'sidebar-active' : '' ?>">
          <i>
            <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 1202.000000 1280.000000" preserveAspectRatio="xMidYMid meet">
              <g transform="translate(0.000000,1280.000000) scale(0.100000,-0.100000)" fill="currentColor" stroke="none">
                <path d="M10327 12708 c-4 -35 -43 -358 -87 -718 -44 -360 -94 -765 -110 -900
                -99 -810 -120 -982 -120 -986 0 -2 -36 -4 -80 -4 l-80 0 0 -75 0 -75 125 0
                125 0 0 -955 0 -955 -45 0 -45 0 0 -75 0 -75 -185 0 -185 0 0 -155 0 -155 185
                0 185 0 0 -1460 0 -1460 -185 0 -185 0 0 -155 0 -155 105 0 105 0 0 -240 0
                -240 -3165 0 -3165 0 0 120 0 120 -242 2 -243 3 -3 1228 -2 1227 70 0 70 0 0
                100 0 100 -120 0 -120 0 0 955 0 955 120 0 120 0 0 100 0 100 -120 0 -120 0 0
                50 c0 49 -1 50 -30 50 l-30 0 0 625 0 625 80 0 80 0 0 48 0 47 -47 0 c-44 0
                -48 2 -55 30 -4 17 -55 388 -113 825 -58 437 -109 815 -113 840 l-8 45 -7 -70
                c-5 -38 -24 -198 -43 -355 -72 -592 -105 -861 -130 -1065 -33 -281 -25 -255
                -84 -255 l-50 0 0 -45 0 -45 80 0 80 0 0 -624 0 -625 -27 -3 c-26 -3 -28 -7
                -31 -50 l-3 -47 -117 -3 -117 -3 -3 -97 -3 -98 121 0 120 0 0 -955 0 -954
                -117 -3 -118 -3 -2 -97 -1 -98 69 0 69 0 0 -1230 0 -1230 -980 0 -980 0 0
                -1855 0 -1855 -210 0 -210 0 0 -200 0 -200 6010 0 6010 0 0 200 0 200 -580 2
                -580 3 -3 1972 -2 1972 105 3 105 3 3 153 3 152 -186 0 -185 0 0 1460 0 1460
                185 0 186 0 -3 153 -3 152 -182 3 -183 2 0 75 0 75 -45 0 -45 0 0 955 0 955
                124 0 123 0 2 75 2 75 -80 0 c-75 0 -81 1 -85 23 -3 12 -55 400 -116 862 -61
                462 -115 869 -120 905 -5 36 -33 245 -61 465 -29 220 -55 404 -59 408 -4 4
                -10 -20 -13 -55z m-8259 -9558 c230 -38 441 -219 536 -460 63 -161 60 -94 63
                -1242 l4 -1048 -701 0 -700 0 0 999 c0 654 4 1027 11 1078 14 105 61 243 111
                327 51 87 169 211 242 255 143 86 282 115 434 91z m2206 -95 c76 -20 139 -65
                173 -123 l28 -47 0 -315 0 -315 -282 -3 -283 -2 0 302 c0 181 4 318 11 341 20
                73 100 140 193 163 69 17 92 17 160 -1z m1096 -28 c45 -23 73 -45 95 -75 l30
                -44 3 -329 3 -329 -281 0 -280 0 0 310 c0 343 2 355 63 418 90 94 237 114 367
                49z m1029 0 c44 -22 73 -45 95 -75 l31 -44 3 -329 3 -329 -281 0 -280 0 0 310
                c0 343 2 355 63 418 91 95 236 114 366 49z m1011 12 c54 -24 105 -71 131 -121
                18 -34 19 -62 19 -353 l0 -315 -280 0 -280 0 0 315 c0 346 1 355 60 413 87 87
                232 112 350 61z m962 20 c68 -15 115 -39 155 -81 61 -63 63 -75 63 -418 l0
                -310 -280 0 -281 0 3 329 3 329 30 43 c34 48 112 96 176 108 62 12 72 12 131
                0z m1030 0 c100 -21 186 -90 207 -166 7 -23 11 -160 11 -341 l0 -302 -281 2
                -280 3 1 320 1 319 24 43 c31 52 97 98 167 117 66 18 84 19 150 5z m-5091
                -1289 c58 -30 115 -93 150 -166 56 -118 59 -150 59 -701 l0 -503 -306 0 -305
                0 3 527 c4 579 3 564 68 693 30 58 95 127 145 153 44 23 137 22 186 -3z m1005
                0 c82 -40 151 -139 192 -273 13 -43 16 -141 19 -574 l5 -523 -306 0 -306 0 0
                513 c0 484 1 516 20 586 11 40 32 95 46 123 30 59 101 133 147 153 48 21 133
                19 183 -5z m1031 -1 c80 -39 152 -143 189 -274 15 -52 18 -128 22 -577 l4
                -518 -306 0 -306 0 0 513 c0 562 2 582 60 697 61 121 140 180 239 180 35 0 70
                -8 98 -21z m1029 0 c54 -26 105 -82 144 -159 58 -115 60 -135 60 -697 l0 -513
                -300 0 -300 0 0 518 c0 492 1 521 21 592 33 123 101 219 182 259 56 28 137 28
                193 0z m1051 0 c80 -39 152 -143 189 -274 15 -52 18 -128 22 -577 l4 -518
                -306 0 -306 0 0 513 c0 562 2 582 60 697 61 121 140 180 239 180 35 0 70 -8
                98 -21z m1023 -11 c66 -40 129 -127 162 -226 22 -66 23 -77 26 -600 l3 -532
                -306 0 -305 0 0 488 c1 536 5 593 58 707 34 72 99 148 151 175 23 12 57 19 96
                20 51 0 70 -5 115 -32z" />
                <path d="M6512 11014 c-91 -24 -164 -66 -234 -135 -113 -110 -166 -253 -155
                -409 15 -197 128 -357 310 -440 l67 -30 0 -379 0 -380 -42 -23 c-109 -60 -127
                -195 -37 -280 l39 -37 0 -245 0 -245 -42 -19 c-48 -21 -111 -85 -131 -134 -8
                -19 -17 -54 -21 -80 l-7 -47 -47 -6 c-380 -49 -790 -223 -1107 -470 -65 -50
                -90 -63 -130 -69 -147 -22 -255 -131 -255 -259 0 -42 -6 -57 -54 -121 -173
                -233 -316 -537 -385 -811 -36 -148 -71 -388 -71 -496 0 -41 -4 -47 -90 -126
                -155 -145 -264 -313 -329 -509 -90 -268 -79 -579 31 -841 l30 -73 174 0 174 0
                0 -35 0 -35 -237 -2 -238 -3 -3 -167 -2 -168 1215 0 1215 0 0 30 0 30 1360 0
                1360 0 0 320 0 320 -1376 0 -1376 0 5 22 c3 13 9 49 12 81 l7 57 1243 0 1243
                0 52 123 c119 282 180 584 180 900 0 263 -37 490 -120 741 -192 575 -614 1062
                -1158 1335 -224 113 -491 196 -724 226 -45 6 -48 8 -48 35 0 86 -76 197 -159
                235 l-41 18 0 244 0 244 36 32 c101 88 78 241 -44 292 l-32 14 2 373 3 373 43
                -3 c66 -6 168 17 250 54 77 35 180 123 217 186 l19 33 -44 -38 c-64 -54 -139
                -88 -225 -100 -202 -29 -389 71 -481 259 -35 70 -39 86 -42 173 -5 112 16 190
                75 278 61 92 177 173 277 193 37 7 35 8 -29 8 -38 0 -94 -6 -123 -14z m-1523
                -3456 c-3 -2 -37 -34 -77 -73 -75 -73 -99 -71 -36 3 33 39 103 86 113 76 2 -2
                2 -5 0 -6z" />
              </g>
            </svg>
          </i>
            <span>Masjid</span>
          </li>
        </a>
      </ul>
    </section>

    <!-- navbar -->
    <section class="w-full h-14 bg-darkgreen shadow-md">
      <div class="flex justify-between items-center h-full px-5 gap-5">
        <!-- button toggle -->
        <button id="hamburger" name="hamburger" class="">
          <span class="hamburger-line bg-white transition-500 origin-top-left"></span>
          <span class="hamburger-line bg-white transition-500"></span>
          <span class="hamburger-line bg-white transition-500 origin-bottom-left"></span>
        </button>

        <!-- search -->
        <div class="search relative w-72 text-darkgray">
          <input type="search" name="" id="" class="outline-none px-2 py-1 rounded-full relative w-full">
          <button class="absolute right-3 bottom-0 top-0">
            <img src="<?= BASEURL ?>/svg/search.svg" alt="">
          </button>
        </div>

        <!-- profile -->
        <div class="flex items-center justify-evenly w-32 hover:cursor-pointer gap-1">
          <div class="profil bg-white">
            <img src="<?= BASEURL ?>/svg/person-circle.svg" alt="" width="100%">
          </div>
          <div class="text-white">Admin</div>
          <i>
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="30" class="bi bi-caret-down-fill fill-white" viewBox="0 0 16 16">
              <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
            </svg>
          </i>
        </div>
      </div>
    </section>
  </div>