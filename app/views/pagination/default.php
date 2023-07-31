<?php 
$url = explode('/', $_GET['url']);
$url = BASEURL . '/' . $url[0] . '/' . $url[1] . '/';

// jika halaman melampui jumlah halaman
if($data['prev_page'] > $data['jumlah_page']) {
    $data['prev_page'] = 1;
}

// jika halaman kurang dari 0
if($data['next_page'] < 0) {
    $data['next_page'] = 1;
}
?>

<div class="mt-5 flex justify-center text-sm">
    <?php if($data['prev_page'] > 0): ?>
        <a href="<?= $url . $data['prev_page'] ?>" class="px-3 py-2 border border-gray-400 rounded-md text-gray-600">&laquo; Prev</a>
    <?php endif ?>
    
    <?php for ($i = $data['start_page']; $i <= $data['end_page']; $i++): ?>
        <?php if($i === $data['page']): ?>
            <a href="<?= $url . $i ?>" class="px-3 py-2 bg-green text-white rounded-md mx-1"><?= $i ?></a>
        <?php else: ?>
            <a href="<?= $url . $i ?>" class="px-3 py-2 bg-gray-200 text-gray-600 rounded-md mx-1"><?= $i ?></a>
        <?php endif ?>
    <?php endfor ?>
    
    <?php if($data['next_page'] <= $data['jumlah_page']): ?>
        <a href="<?= $url . $data['next_page'] ?>" class="px-3 py-2 border border-gray-400 rounded-md text-gray-600">Next &raquo;</a>
    <?php endif ?>
</div>