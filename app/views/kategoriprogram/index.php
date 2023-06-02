<!-- lib vue -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js" defer></script>
<script src="http://localhost/Pzakat/public/static/js/app.js" defer></script>

<!-- Page Heading -->
<h2 class="h3">Kategori Program</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Daftar Kategori Program</h6>
    </div>

    <div class="container mt-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-add-kategori-program" data-toggle="modal" data-target="#formModal">
            Tambah Kategori
        </button>
    </div>


    <div class="card-body">
        <?php Flasher::flash() ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Ditambahkan Oleh</th>
                        <th>Terakhir Ditambahkan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['dataKategoriProgram'] as $item) : ?>
                        <tr>
                            <td><?= $item['nama_kategori_program'] ?></td>
                            <td><?= $item['username_amil'] ?></td>
                            <td><?= $item['datetime'] ?></td>
                            <td>
                                <a href="<?= BASEURL ?>/masjid/ubah/<?= $item['id_mesjid'] ?>" class="btn badge btn-success btn-update-data-masjid" data-id="<?= $item['id_mesjid'] ?>" data-toggle="modal" data-target="#formModal">Ubah</a>
                                <a href="<?= BASEURL ?>/kategoriprogram/aksi_hapus_kategori/<?= $item['id_kategori_program'] ?>" class="btn badge btn-danger">Hapus</a>
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
                <h3 class="modal-title fs-5" id="formModalLabel">Tambah Data Kategori Program</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="" method="post">

                <div class="modal-body">
                    <input type="hidden" name="username_amil" value="<?= $_SESSION['username'] ?>">
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required autocomplete="off">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>