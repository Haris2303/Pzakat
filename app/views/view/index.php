<div class="container">
  <div class="content">
    <div class="title mb-5">
      <h3 class="text-title"><?= $data['judul'] ?></h3>
      <!-- <span class="text-sm text-lightgray mt-2 inline-block">Silahkan pilih program donasi yang anda inginkan</span> -->
      <div class="text-center mt-5">
        <div class="inline-flex text-lightgray items-center mr-5">
          <span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#999" class="bi bi-person-circle" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
            </svg></span>
          <span>Dibuat oleh: <strong><?= $data['dataView']['nama_penulis'] ?></strong></span>
        </div>
  
        <div class="inline-flex items-center text-lightgray">
          <span class="mr-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#999" class="bi bi-calendar3" viewBox="0 0 16 16">
              <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
              <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            </svg></span>
          <span>Dibuat pada: <strong><?= explode(' ',$data['dataView']['datetime'])[0] ?></strong></span>
        </div>
      </div>
    </div>

    <div class="mt-5">
      <img src="<?= BASEURL ?>/img/views/<?= $data['dataView']['gambar'] ?>" alt="" width="100%"><br>
    </div>
  
    <div class="text-lightgray space-y-5">
      <?= $data['dataView']['content'] ?>
    </div>

  </div>
</div>