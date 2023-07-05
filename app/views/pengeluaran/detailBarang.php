<!-- Page Heading -->
<h2 class="h3">Detail Pengeluaran <?= $data['detail']['jenis_program'] ?> Barang</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Detail Pengeluaran | <span class="mt-3 ml-2 text-secondary"> &nbsp;<i class="fas fa-calendar"></i> <?= explode(' ',$data['detail']['tanggal'])[0] ?> <i class="fas fa-clock"></i> <?= explode(' ',$data['detail']['tanggal'])[1] ?></span></h6>
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
                    <td>: <?= ucwords($data['detail']['jenis_pengeluaran']) ?></td>
                </tr>
                <tr>
                    <th>Nominal diterima</th>
                    <td>: <?= number_format($data['detail']['nominal'], 0, ',', '.') ?> gram / <?= Utility::convertGramToKilogram($data['detail']['nominal']) ?> kilogram</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>: <?= $data['detail']['keterangan'] ?></td>
                </tr>
            </table>
        </div>
        <div class="mt-3">
            <a href="<?= BASEURL ?>/pengeluaran/barang" class="btn btn-secondary"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
    </div>
</div>