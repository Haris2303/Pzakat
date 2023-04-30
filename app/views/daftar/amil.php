<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zakat | <?= $data['judul'] ?></title>

  <!-- icon shorcut -->
  <link rel="shortcut icon" href="<?= BASEURL ?>/img/logo/logo.png" type="image/x-icon">
  <!-- my css -->
  <link rel="stylesheet" href="<?= BASEURL ?>/css/app.css">
</head>

<body class="bg-white">

  
  <div class="container h-screen flex justify-center items-center">
    <div class="content">
      
      <div class="flex justify-center items-center p-14 bg-green border-green shadow-xl shadow-green flex-col gap-5 text-darkgreen rounded-lg">
        <div class="text-3xl font-bold">
          Daftar Amil
        </div>

      <?php Flasher::flash() ?>
        
      <form action="<?= BASEURL ?>/daftar/aksi_daftar" method="POST" class="flex gap-3 flex-col text-lightgreen">
        <input type="text" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="name" placeholder="Nama Lengkap" autocomplete="off" required>
        <input type="text" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="email" placeholder="Email" autocomplete="off" required>
        <input type="tel" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="nohp" placeholder="No HP" autocomplete="off" required>
        <input type="text" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="username" placeholder="Username" autocomplete="off" required>
        <input type="password" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="password" placeholder="Password" autocomplete="off" required>
        <input type="password" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="passConfirm" placeholder="Konfirmasi Password" autocomplete="off" required>
        <button type="submit" class="btn btn-green hover:shadow-sm hover:shadow-green">Daftar</button>
        <a href="<?php echo BASEURL ?>/daftar">Daftar Sebagai Muzaqqi</a>
      </form>
    </div>
  </div>
</div>

</body>
</html>