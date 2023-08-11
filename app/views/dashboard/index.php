

      <!-- Begin Page Content -->
      <!-- <div class="container-fluid"> -->

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>

        <?php Flasher::flash() ?>
        <!-- Content Row -->
        <div class="row">

          <!-- Earnings (Monthly) Card Donasi -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      Donasi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($data['sumDanaDonasi'] <= 0) ? "Dana Belum Masuk" : 'Rp ' . $data['sumDanaDonasi'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Zakat -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      Zakat</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($data['sumDanaZakat'] <= 0) ? "Dana Belum Masuk" : 'Rp ' . $data['sumDanaZakat'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      Qurban</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($data['sumDanaQurban'] <= 0) ? "Dana Belum Masuk" : 'Rp ' . $data['sumDanaQurban'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Infaq -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      Infaq</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($data['sumDanaInfaq'] <= 0) ? "Dana Belum Masuk" : 'Rp ' . $data['sumDanaInfaq'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Ramadhan -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      Ramadhan</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($data['sumDanaRamadhan'] <= 0) ? "Dana Belum Masuk" : 'Rp ' . $data['sumDanaRamadhan'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      Muzakki</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data['countMuzakki'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tasks
                    </div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                      </div>
                      <div class="col">
                        <div class="progress progress-sm mr-2">
                          <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                      Konfirmasi Requests</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?= ($data['countKonfirmasi'] <= 0) ? "Belum Ada Konfirmasi" : $data['countKonfirmasi'] ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Content Row -->

        <div class="row">

          <!-- Area Chart -->
          <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
              <!-- Card Header - Dropdown -->
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Pemasukkan Tahun ini <?php echo date('Y') ?></h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </div>
              <!-- Card Body -->
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myAreaChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Content Row -->
        <div class="row">

          <div class="col-lg-6 mb-4">
            <!-- Kalender -->
            <div class="card shadow">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Kalender</h6>
              </div>
              <div class="calendar">
                <div class="month text-primary">
                  <i class="fas fa-angle-left prev"></i>
                  <div class="date">
                    <h1></h1>
                    <p></p>
                  </div>
                  <i class="fas fa-angle-right next"></i>
                </div>
                <div class="weekdays text-primary">
                  <div>Minggu</div>
                  <div>Senin</div>
                  <div>Selasa</div>
                  <div>Rabu</div>
                  <div>Kamis</div>
                  <div>Jumat</div>
                  <div>Sabtu</div>
                </div>
                <div class="days"></div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-4">
            <!-- About App -->
            <div class="card shadow">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Apa itu Lazismu?</h6>
              </div>
              <div class="card-body">
                <p>LAZISMU adalah lembaga zakat nasional dengan SK Menag No. 90 Tahun 2022, yang berkhidmat dalam pemberdayaan masyarakat melalui pendayagunaan dana zakat, infaq, wakaf dan dana kedermawanan lainnya baik dari perseorangan, lembaga, perusahaan dan instansi lainnya.</p>
                <p class="mb-0">Lazismu tidak menerima segala bentuk dana yang bersumber dari kejahatan. UU RI No. 8 Tahun 2010 Tentang Pencegahan dan Pemberantasan Tindak Pidana Pencucian Uang.</p>
              </div>
            </div>
          </div>

        </div>

      <!-- </div> -->
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <footer class="sticky-footer bg-white">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; Your Website 2021</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>