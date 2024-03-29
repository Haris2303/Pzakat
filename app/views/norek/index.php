<!-- Page Heading -->
<h2 class="h3">Nomor Rekening</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row justify-content-between align-items-center mx-0">
            <div>
                <h6 class="m-0 font-weight-bold text-dark">Daftar Nomor Rekening</h6>
            </div>
            <div class="position-relative">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#formNorekModal">
                    Tambah <i class="ml-1 fas fa-plus-circle"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <!-- flasher alert -->
        <?php Flasher::flash() ?>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Bank</th>
                        <th>Norek</th>
                        <th>Nama Pemilik</th>
                        <th>Saldo Donasi</th>
                        <th>Jenis Program</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['dataNorek'] as $item) : ?>
                        <tr>
                            <td><?= $item['nama_bank'] ?></td>
                            <td><?= $item['norek'] ?></td>
                            <td><?= $item['nama_pemilik'] ?></td>
                            <td><?= number_format($item['saldo_donasi'], 0, ',', '.') ?></td>
                            <td><?= $item['jenis_program'] ?></td>
                            <td><img src="<?= BASEURL ?>/img/norek/<?= $item['gambar'] ?>" alt="<?= $item['gambar'] ?>" width="100px"></td>
                            <td>
                                <button type="submit" class="btn badge btn-success btn-ubah-norek" data-toggle="modal" data-target="#formNorekModal" data-id="<?= $item['id_norek'] ?>">Ubah</button>
                                <form action="" id="form-delete" class="d-inline">
                                    <button type="submit" id="btn-delete" class="btn badge btn-danger" data-uuid="<?= $item['UUID'] ?>">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="formNorekModal" tabindex="-1" aria-labelledby="formNorekModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="formNorekModalLabel">Tambah Nomor Rekening</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="<?= BASEURL ?>/norek/aksi_tambah_norek" method="post">

                <div class="modal-body">

                    <div class="mb-3 bank">
                        <label for="browser">Pilh Nama Bank Pada List:</label>
                        <input list="browsers" name="nama-bank" id="browser" class="form-control">
                        <datalist id="browsers">
                            <?php foreach ($data['dataBank'] as $item) : ?>
                                <option value="<?= $item['name'] ?>">
                                <?php endforeach ?>
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="nama-pemilik" class="form-label">Nama Pemilikk Rekening</label>
                        <input type="text" class="form-control" id="nama-pemilik" name="nama-pemilik" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="norek" class="form-label">Norek</label>
                        <input type="text" class="form-control" id="norek" name="norek" required autocomplete="off" onkeydown="return countInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="jenis-program" class="form-label">Jenis Program</label>
                        <select name="jenis-program" id="jenis-program" class="form-control">
                            <option selected disabled> -- Pilih Jenis Program -- </option>
                            <?php foreach ($data['programNameAktif'] as $item) : ?>
                                <option value="<?= $item['nama_kategoriprogram'] ?>"><?= $item['nama_kategoriprogram'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>