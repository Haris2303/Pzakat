<!-- Page Heading -->
<h2 class="h3">Youtube Video</h2>
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
  For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-dark">Video Player</h6>

    </div>


    <div class="card-body">
        <div class="mt-3">
            <div class="col-lg-6">
                <?php Flasher::flash() ?>
                <!-- preview video -->
                <iframe width="100%" height="285" src="<?= $data['src'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                <span>Diubah pada <?= $data['time'] ?></span>
                <!-- form -->
                <form action="<?= BASEURL ?>/video_player/aksi_ubah_source" method="post" class="mt-5">
                    <label for="link" class="form-label text-dark">Source Video Youtube</label>
                    <input type="text" name="link" id="link" class="form-control" value="<?= $data['src'] ?>">
                    
                    <!-- Button trigger modal ubah -->
                    <button type="submit" class="btn btn-primary mt-4" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-edit"></i> Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>