<!-- Page Heading -->
<h2 class="h3">Pengeluaran <span class="text-primary">Tunai</span></h2>
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
                        <th>Jenis Program</th>
                        <th>Nominal/Berat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['dataPengeluaran'] as $item) : ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="<?= BASEURL ?>/kelola_pembayaran/detailbarang/<?= $item['id_donasibarang'] ?>" class="btn badge btn-secondary">Detail</a>
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
                    <div class="mb-3">
                        <label for="nama-penerima" class="form-label">Nama Penerima</label>
                        <input type="text" name="nama-penerima" id="nama-penerima" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="nama-program" class="form-label">Nama Program</label>
                        <select name="id-program" id="nama-program" class="form-control">
                            <option selected disabled>-- Pilih Nama Program --</option>
                            <?php foreach ($data['dataProgram'] as $item) : ?>
                                <option value="<?= $item['id_program'] ?>" data-jenis="<?= $item['jenis_program'] ?>"><?= $item['jenis_program'] ?> | <?= $item['nama_program'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rekening-bank" class="form-label">Rekening Bank</label>
                        <select name="id-bank" id="rekening-bank" class="form-control">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nominal" class="form-label">Nominal</label>
                        <input type="text" name="nominal" id="nominal" class="form-control" placeholder="nominal pengeluaran" required>
                    </div>
                    <div class="mb-3">
                        <label for="nohp" class="form-label">Nomor Telepon</label>
                        <input type="text" name="nohp" id="nohp" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" placeholder="alamat penerima"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="(optional)"></textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-circle-left"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>