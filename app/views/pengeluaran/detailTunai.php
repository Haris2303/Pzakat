<!-- Page Heading -->
<h2 class="h3 text-dark">Detail Pengeluaran <?= $data['detail']['jenis_program'] ?> <span class="text-warning">Tunai</span></h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Data Pengeluaran | <span class="mt-3 ml-2 text-secondary"> &nbsp;<i class="fas fa-calendar"></i> <?= explode(' ',$data['detail']['tanggal'])[0] ?> <i class="fas fa-clock"></i> <?= explode(' ',$data['detail']['tanggal'])[1] ?></span> | <span class="text-secondary"> by. <?= $data['detail']['nama_amil'] ?></span></h6>
    </div>

    <div class="card-body">
        <?php Flasher::flash() ?>
        <div class="table-responsive">
            <table cellpadding="5">
                <tr>
                    <th>Nama Penerima</th>
                    <td>: <?= $data['detail']['nama_penerima'] ?></td>
                </tr>
                <tr>
                    <th>No Handphone</th>
                    <td>: <?= $data['detail']['nohp'] ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>: <?= $data['detail']['alamat'] ?></td>
                </tr>
                <tr>
                    <th>Nama Program</th>
                    <td>: <?= $data['detail']['nama_program'] ?></td>
                </tr>
                <tr>
                    <th>Jenis Pengeluaran</th>
                    <td>: <?= $data['detail']['jenis_pengeluaran'] ?></td>
                </tr>
                <tr>
                    <th>Nominal diterima</th>
                    <td>: Rp <?= number_format($data['detail']['nominal'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>: <?= $data['detail']['keterangan'] ?></td>
                </tr>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <th class="text-dark">Rekening Terpakai</th>
                </tr>
                <tr>
                    <th>Nama Pemilik Rekening</th>
                    <td>: <?= $data['detail']['nama_pemilik'] ?></td>
                </tr>
                <tr>
                    <th>Nama Bank</th>
                    <td>: <?= $data['detail']['nama_bank'] ?></td>
                </tr>
                <tr>
                    <th>Nomor Rekening</th>
                    <td>: <?= $data['detail']['norek'] ?></td>
                </tr>
            </table>
        </div>
        <div class="mt-3">
            <a href="<?= BASEURL ?>/pengeluaran/" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
    </div>
</div>