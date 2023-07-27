<!-- Page Heading -->
<h2 class="h3">Pengeluaran <span class="text-warning">Tunai</span></h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row justify-content-between align-items-center mx-0">
            <div>
                <h6 class="m-0 font-weight-bold text-dark">Data Tabel Pengeluaran</h6>
            </div>
            <div class="position-relative">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#formModal">
                    Tambah Pengeluaran <i class="ml-1 fas fa-plus-circle"></i>
                </button>
            </div>
        </div>

    </div>


    <div class="card-body">
        <?php Flasher::flash() ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Penerima</th>
                        <th>Nama Program</th>
                        <th>Nominal (Rp)</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['dataPengeluaran'] as $item) : ?>
                        <tr>
                            <td><?= $item['nama_penerima'] ?></td>
                            <td><?= $item['nama_program'] ?></td>
                            <td><?= number_format($item['nominal'], 0, ',', '.') ?></td>
                            <td><?= explode(' ', $item['tanggal'])[0] ?></td>
                            <td>
                                <a href="<?= BASEURL ?>/pengeluaran/detailTunai/<?= $item['id_pengeluaran'] ?>" class="btn badge btn-secondary">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="formModalLabel">Tambah Data Pengeluaran</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="<?= BASEURL ?>/pengeluaran/aksi_tambah_pengeluaran_tunai" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="username_amil" value="<?= $_SESSION['username'] ?>" readonly>
                    <div class="mb-3">
                        <label for="nama-penerima" class="form-label">Nama Penerima</label>
                        <input type="text" name="nama-penerima" id="nama-penerima" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="rekening-bank" class="form-label">Rekening Bank</label>
                        <select name="id-bank" id="rekening-bank" class="form-control" required>
                            <?php foreach ($data['dataRekening'] as $item): ?>
                                <option value="<?= $item['id_norek'] ?>" data-saldo="<?= $item['saldo_donasi'] ?>" data-jenis=<?= $item['jenis_program'] ?>><?= $item['nama_bank'] ?> -- <?= strtoupper($item['jenis_program']) ?> ( <?= $item['nama_pemilik'] ?> )</option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama-program" class="form-label">Nama Program</label>
                        <select name="id-program" id="nama-program" class="form-control" required>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal (Rp)</label>
                        <input type="text" name="nominal" id="nominal" class="form-control" placeholder="nominal pengeluaran" required onkeydown="return currency(event)" autocomplete="off">
                        <div id="pesan-nominal" class="form-text"></div>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor Telepon</label>
                        <input type="text" name="nohp" id="nohp" class="form-control" autocomplete="off" required onkeydown="return countInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="alamat penerima" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="(optional)"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary btn-tambah"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>