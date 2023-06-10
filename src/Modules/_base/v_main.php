<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> <?= $title ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php if (empty($_SESSION["loggedin"])) { ?>
  <div class="absolute bg-black w-full h-full opacity-50"></div> <?php } ?>
  <header class="py-3">
    <nav>
      <ul class="flex justify-around ">
        <li><a href="convert">Account</a> </li>
        <li><a href="login">Login</a></li>
        <li><a href="signup">Sign up</a> </li>
      </ul>
    </nav>
  </header>
  <?= $content ?? null ?>
</body>

</html>