<?php

// cek akses 
if (!isset($_SESSION['level'])) {
  header('Location: ' . BASEURL . '/');
  exit;
} else if ($_SESSION['level'] === '3') {
  header('Location: ' . BASEURL . '/');
  exit;
}

$controller = New Controller();

$countKonfirmasi = count($controller->model('Kelolapembayaran_model')->getAllDataPembayaranKonfirmasi());
$programNameAktif = $this->model('Kelolaprogram_model')->getAllProgramNameAktif();

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Yuk Zakat - <?= $data['judul'] ?></title>

  <!-- Custom fonts for this template-->
  <!-- <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/html"> -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= BASEURL ?>/css/bootstrap/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?= BASEURL ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- style plugin -->
  <?php if (isset($data['css'])) : ?>
    <?php foreach ($data['css'] as $src) : ?>
      <link rel="stylesheet" href="<?= BASEURL ?>/<?= $src ?>">
    <?php endforeach ?>
  <?php endif ?>

</head>

<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= BASEURL ?>/dashboard">
      <div class="sidebar-brand-icon rotate-n-15">
        <i class="fas fa-laugh-wink"></i>
      </div>
      <div class="sidebar-brand-text mx-3">Yuk Zakat</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
      <a class="nav-link" href="<?= BASEURL ?>/dashboard">
        <i class="fas fa-fw fa-home"></i>
        <span>Dashboard</span></a>
    </li>
    <!-- sidebar menu admin -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Datas
    </div>

    <!-- item users -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-user-friends"></i>
        <span>Users</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Custom Components:</h6>
          <?php if ($_SESSION['level'] === '1') : ?>
            <a class="collapse-item" href="<?= BASEURL ?>/amil">Amil</a>
            <a class="collapse-item" href="<?= BASEURL ?>/useradmin">Admin</a>
            <?php endif ?>
          <a class="collapse-item" href="<?= BASEURL ?>/muzakki">Muzakki</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Masjid -->
    <li class="nav-item">
      <a class="nav-link" href="<?= BASEURL ?>/masjid">
        <i class="fas fa-fw fa-mosque"></i>
        <span>Masjid</span></a>
    </li>

    <!-- nav item - Program -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#callapsePrograms" aria-expanded="true" aria-controls="callapsePrograms">
        <i class="fas fa-fw fa-folder"></i>
        <span>Programs</span>
      </a>
      <div id="callapsePrograms" class="collapse" aria-labelledby="headingPrograms" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kategori program:</h6>
            <a class="collapse-item" href="<?= BASEURL ?>/kelola_program">Kelola Program</a>
            <?php foreach ($programNameAktif as $item): ?>
              <a class="collapse-item" href="<?= BASEURL ?>/kelola_program/<?= strtolower($item['nama_kategoriprogram']) ?>"><?= $item['nama_kategoriprogram'] ?></a>
            <?php endforeach ?>
        </div>
      </div>
    </li>

    <!-- nav item - Kelola Pembayaran -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#callapsePembayaran" aria-expanded="true" aria-controls="callapsePembayaran">
        <i class="fas fa-fw fa-donate"></i>
        <span>Kelola Pembayaran</span>
      </a>
      <div id="callapsePembayaran" class="collapse" aria-labelledby="headingPrograms" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kategori program:</h6>
            <a class="collapse-item" href="<?= BASEURL ?>/kelola_pembayaran/">Pembayaran Tunai</a>
            <a class="collapse-item" href="<?= BASEURL ?>/kelola_pembayaran/barang">Pembayaran Barang</a>
        </div>
      </div>
    </li>

    <!-- nav item - Pengeluaran -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePengeluaran" aria-expanded="true" aria-controls="collapsePengeluaran">
        <i class="fas fa-fw fa-inbox"></i>
        <span>Pengeluaran</span>
      </a>
      <div id="collapsePengeluaran" class="collapse" aria-labelledby="headingPrograms" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Kategori pengeluaran:</h6>
            <a class="collapse-item" href="<?= BASEURL ?>/pengeluaran/">Pengeluaran Tunai</a>
            <a class="collapse-item" href="<?= BASEURL ?>/pengeluaran/barang">Pengeluaran Barang</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Norek -->
    <li class="nav-item">
      <a class="nav-link" href="<?= BASEURL ?>/norek">
        <i class="fas fa-fw fa-credit-card"></i>
        <span>Nomor Rekening</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
      Interfaces
    </div>

    <!-- Nav Item - Banner -->
    <li class="nav-item">
      <a class="nav-link" href="<?= BASEURL ?>/banner">
        <i class="fas fa-fw fa-file-image"></i>
        <span>Banner</span></a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>Tentang Kami</span>
      </a>
      <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Custom About:</h6>
          <a class="collapse-item" href="<?= BASEURL ?>/admin_latarbelakang">Latar Belakang</a>
          <a class="collapse-item" href="<?= BASEURL ?>/admin_visimisi">Visi MIsi</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Pages</span>
      </a>
      <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Views</h6>
          <a class="collapse-item" href="<?= BASEURL ?>/pageviews/berita">Berita</a>
          <a class="collapse-item" href="<?= BASEURL ?>/pageviews/artikel">Artikel</a>
          <div class="collapse-divider"></div>
          <h6 class="collapse-header">Other Pages:</h6>
          <a class="collapse-item" href="404.html">404 Page</a>
          <a class="collapse-item" href="blank.html">Blank Page</a>
        </div>
      </div>
    </li>

    <!-- Nav Item - Laporan -->
    <li class="nav-item">
      <a class="nav-link" href="charts.html">
        <i class="fas fa-fw fa-file"></i>
        <span>Laporan</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>

        <!-- Topbar Search -->
        <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
          <div class="input-group">
            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
              <button class="btn btn-primary" type="button">
                <i class="fas fa-search fa-sm"></i>
              </button>
            </div>
          </div>
        </form> -->

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>

          <!-- Nav Item - Notifikasi -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-bell fa-fw"></i>
              <!-- Counter - Notifikasi -->
              <!-- <span class="badge badge-danger badge-counter">3+</span> -->
              <?php if($countKonfirmasi > 0): ?><span class="badge badge-danger badge-counter mr-3"><?= $countKonfirmasi ?>+</span><?php endif ?>
            </a>
            <!-- Dropdown - Notifikasi -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
              <h6 class="dropdown-header">
                Notifikasi Pembayaran
              </h6>
              <?php if($countKonfirmasi > 0): ?>
                <a class="dropdown-item d-flex align-items-center" href="<?= BASEURL ?>/kelola_pembayaran/konfirmasi">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">Konfirmasi Pembayaran</div>
                    <span class="font-weight-bold">Terdapat <?= $countKonfirmasi ?> pembayaran belum terkonfirmasi!</span>
                  </div>
                </a>
              <?php else: ?>
                <a class="dropdown-item text-center small text-secondary">Belum ada notifikasi</a>
              <?php endif ?>
            </div>
          </li>

          <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-envelope fa-fw"></i>
              <!-- Counter - Messages -->
              <span class="badge badge-danger badge-counter">7</span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header">
                Message Center
              </h6>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="img/undraw_profile_1.svg" alt="...">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div class="font-weight-bold">
                  <div class="text-truncate">Hi there! I am wondering if you can help me with a
                    problem I've been having.</div>
                  <div class="small text-gray-500">Emily Fowler · 58m</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="img/undraw_profile_2.svg" alt="...">
                  <div class="status-indicator"></div>
                </div>
                <div>
                  <div class="text-truncate">I have the photos that you ordered last month, how
                    would you like them sent to you?</div>
                  <div class="small text-gray-500">Jae Chun · 1d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="img/undraw_profile_3.svg" alt="...">
                  <div class="status-indicator bg-warning"></div>
                </div>
                <div>
                  <div class="text-truncate">Last month's report looks great, I am very happy with
                    the progress so far, keep up the good work!</div>
                  <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                </div>
              </a>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <div class="dropdown-list-image mr-3">
                  <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="...">
                  <div class="status-indicator bg-success"></div>
                </div>
                <div>
                  <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                    told me that people say this to all dogs, even if they aren't good...</div>
                  <div class="small text-gray-500">Chicken the Dog · 2w</div>
                </div>
              </a>
              <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
            </div>
          </li>

          <div class="topbar-divider d-none d-sm-block"></div>

          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['username'] ?></span>
              <img class="img-profile rounded-circle" src="svg/undraw_profile.svg">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
              <a class="dropdown-item" href="#">
                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
            </div>
          </li>

        </ul>

      </nav>
      <!-- End of Topbar -->


      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="<?= BASEURL ?>/userlogout">Logout</a>
            </div>
          </div>
        </div>
      </div>

<div class="container-fluid">