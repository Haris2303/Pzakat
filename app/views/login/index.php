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
  <link rel="stylesheet" href="<?= BASEURL ?>/css/main.css">
</head>

<body class="bg-darkgreen">

  
  <div class="container h-screen flex justify-center items-center">
    <div class="content">
      
      <div class="flex justify-center items-center p-14 bg-green border-green shadow-xl shadow-green flex-col gap-5 text-darkgreen rounded-lg">
        <div class="text-3xl font-bold">
          Login
        </div>

        <?php Flasher::flash() ?>
        
      <form action="<?= BASEURL ?>/login/aksi_login" method="POST" class="flex gap-3 flex-col text-lightgreen">
        <input type="text" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="username" placeholder="username" autocomplete="off">
        <input type="password" class="p-2 border-2 border-darkgreen outline-none rounded-sm focus:shadow-sm focus:shadow-green transition-500 bg-darkgreen placeholder:text-lightgreen" name="password" placeholder="password" autocomplete="off">
        <button type="submit" class="btn btn-green hover:shadow-sm hover:shadow-green" name="login">Login</button>
      </form>
    </div>
  </div>
</div>

</body>
</html>