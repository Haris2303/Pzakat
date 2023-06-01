<!-- Page Heading -->
<h2 class="h3">Nomor Rekening</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Nomor Rekening</h6>
    </div>

    <div class="container mt-3">
        <!-- Button trigger modal -->
        <?php Flasher::flash() ?>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i> Norek
        </button>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Bank</th>
                        <th>Norek</th>
                        <th>Nama Pemilik</th>
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
                            <td><img src="<?= BASEURL ?>/img/norek/<?= $item['gambar'] ?>" alt="<?= $item['gambar'] ?>" width="100px"></td>
                            <td>
                                <a href="<?= BASEURL ?>/norek/detail/<?= $item['id_norek'] ?>" class="btn badge btn-success">Ubah</a>
                                <a href="<?= BASEURL ?>/norek/aksi_hapus_norek/<?= $item['id_norek'] ?>" class="btn badge btn-danger" onclick="return confirm('Anda yakin ingin menghapus norek tersebut?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="exampleModalLabel">Tambah Nomor Rekening</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="<?= BASEURL ?>/norek/aksi_tambah_norek" method="post" enctype="multipart/form-data">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Bank</label>
                        <input type="text" class="form-control" id="nama" name="nama-bank" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="nama-pemilik" class="form-label">Nama Pemilikk Rekening</label>
                        <input type="text" class="form-control" id="nama-pemilik" name="nama-pemilik" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="norek" class="form-label">Norek</label>
                        <input type="tel" class="form-control" id="norek" name="norek" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Bank</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" required autocomplete="off">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>