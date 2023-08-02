<div class="container">
  <div class="content">
    <div class="title mb-5">
      <h3 class="text-title">Artikel</h3>
      <span class="text-sm text-lightgray mt-2 inline-block">Artikel - artikel Lazismu Unamin</span>
    </div>

    <div class="flex">
      <div class="w-full flex flex-col gap-y-5 flex-wrap lg:flex-row text-sm">
        <?php foreach ($data['dataArtikel'] as $item) : ?>
  
          <div class="lg:w-1/3 px-3">
            <div class="shadow-lg pb-1">
              <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>">
                <img src="<?= BASEURL ?>/img/views/<?= $item['gambar'] ?>" alt="" class="lg:h-48 h-64 w-full">
              </a>
              <div class="px-4 my-4 flex flex-col gap-1">
                <a href="">
                  <h4 class="text-lg text-darkgray"><?= $item['judul'] ?></h4>
                </a>
  
                <!-- date and time -->
                <div class="flex text-xs text-darkgreen gap-2">
                  <div class="date flex gap-1">
                    <logo><svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" class="bi bi-calendar3 fill-darkgreen" viewBox="0 0 16 16">
                        <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                        <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                      </svg></logo>
                    <text><?= explode(' ', $item['datetime'])[0] ?></text>
                  </div>
                  <div class="time flex gap-1">
                    <logo><svg xmlns="http://www.w3.org/2000/svg" width="10" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                        <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                      </svg></logo>
                    <text><?= explode(' ', $item['datetime'])[1] ?> WIT</text>
                  </div>
                </div>
  
                <div class="flex justify-between flex-wrap text-md max-h-20 overflow-hidden">
                  <p class="font-light text-lightgray leading-6">
                    <?= $item['content'] ?>
                  </p>
                </div>
                <a href="<?= BASEURL ?>/view/<?= $item['slug'] ?>" class="btn btn-green">Lihat Selengkapnya...</a>
              </div>
            </div>
          </div>
  
        <?php endforeach ?>
      </div>
    </div>
    <?php Pagination::view(5) ?>
  </div>
</div>