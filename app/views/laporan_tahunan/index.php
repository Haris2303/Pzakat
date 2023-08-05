<!-- Page Heading -->
<h2 class="h3 text-dark">Laporan Tahunan</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row justify-content-between align-items-center mx-0">
            <div>
                <h6 class="m-0 font-weight-bold text-dark">Daftar Laporan</h6>
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
                        <th>Tahun</th>
                        <th>Link</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data['laporan'] as $item) : ?>
                        <tr>
                            <td><?= $item['tahun'] ?></td>
                            <td><?= $item['link'] ?></td>
                            <td><?= $item['keterangan'] ?></td>
                            <td>
                                <form action="<?= BASEURL ?>/laporan_tahunan/aksi_hapus_laporan" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $item['id_laporan'] ?>">
                                    <button type="submit" class="btn badge btn-danger" onclick="return confirm('Anda yakin ingin menghapus norek tersebut?')">Hapus</button>
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
                <h2 class="modal-title fs-5" id="formNorekModalLabel">Tambah Laporan Tahunan</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="<?= BASEURL ?>/laporan_tahunan/aksi_tambah_laporan" method="post">

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="number" class="form-control" id="tahun" name="tahun" required autocomplete="off" onkeydown="return countInput(event)">
                    </div>
                    <div class="mb-3">
                        <label for="link" class="form-label">Link PDF</label>
                        <input type="url" class="form-control" id="link" name="link" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="3"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-arrow-alt-circle-left"></i> Keluar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>

        </div>
    </div>
</div>