<div class="lg:mt-20 mt-10 w-full">
    <h2 class="font-bold text-xl text-darkgray mb-2">Donasi Sukses</h2>
    <p class="text-sm text-lightgray">Data pembayaran yang belum dibayarkan</p>

    <div class="mt-4 relative overflow-x-auto shadow-md">
        <?php if(count($data['sukses']) > 0): ?>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-white uppercase bg-green">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kode Pembayaran
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
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach($data['sukses'] as $item): ?>
                    <tr class="text-darkgray even:bg-gray-300 hover:bg-lightgreen">
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            <?= $i++ ?>
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                            <?= $item['nomor_pembayaran'] ?>
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
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        <?php else: ?>
            <h2>Data Kosong</h2>
        <?php endif ?>

    </div>

</div>



<!-- Close div container -->
</div>
<!-- close div content -->
</div>