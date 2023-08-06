<div class="lg:mt-20 mt-10 w-full">
    <h2 class="font-bold text-xl text-darkgray mb-2">Pembayaran Pending</h2>
    <p class="text-sm text-lightgray">Data pembayaran yang belum dibayarkan</p>

    <?php Flasher::flash() ?>

    <?php if (count($data['pending']) > 0) : ?>

        <div class="mt-4 relative overflow-x-auto shadow-md">
            <table class="w-full text-sm text-left text-gray-500">
                <thead class="text-xs text-white uppercase bg-green">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Program
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Program
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jumlah Donasi
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = $data['no'] ?>
                    <?php foreach ($data['pending'] as $item) : ?>
                        <?php
                        // waktu expired dari kode
                        $kode_expired = explode('_', $item['nomor_pembayaran'])[1] + (24 * 3600);
                        ?>
                        <tr class="text-darkgray even:bg-gray-300 hover:bg-lightgreen">
                            <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                <?= $i++ ?>
                            </th>
                            <td class="px-6 py-4">
                                <?= $item['nama_program'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <?= $item['jenis_program'] ?>
                            </td>
                            <td class="px-6 py-4">
                                Rp <?= number_format($item['jumlah_pembayaran'], 0, ',', '.') ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if(time() > $kode_expired): ?>
                                    <form action="<?= BASEURL ?>/transaksi/aksi_hapus_transaksi" method="post">
                                        <input type="hidden" name="id" value="<?= $item['id_donatur'] ?>">
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 px-2 py-1 rounded-full text-white text-xs transition-300" onclick="return confirm('Anda akan menghapus data tersebut?')">Expired</button>
                                    </form>
                                <?php else: ?>
                                    <a href="<?= BASEURL ?>/transaksi/summary/<?= $item['nomor_pembayaran'] ?>">
                                        <span class="bg-yellow-600 hover:bg-yellow-800 px-2 py-1 rounded-full text-white transition-300">Bayar</span>
                                    </a>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>

    <?php else : ?>
        <?php echo Design::blankData() ?>
    <?php endif ?>

    <!-- pagination -->
    <?php Pagination::view(4) ?>

</div>


<!-- Close div container -->
</div>
<!-- close div content -->
</div>