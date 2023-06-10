<?php if (empty($_SESSION["loggedin"])) { ?>
<form id="form" class="absolute flex flex-col items-center top-2/4 left-2/4 bg-white px-5 py-5 
  -translate-y-2/4 -translate-x-2/4" method="POST">
  <label for="form"></label>
  <div class=" py-2 w-full">
    <label class="flex justify-between" for="login">Login:
      <input class="border-solid border-orange-500 border-2 mr-10" placeholder="enter login" id='login' name="login"
        value=<?= $_POST['login'] ?? null ?>></label>
  </div>
  <?php if (isset($loginMessage)) {
      foreach ($loginMessage as $message) {
        echo "<div>$message</div>";
      }
    } ?>
  <div class="flex">
    <label class="mr-2" for="password">Password:</label>
    <input class="border-solid border-orange-500 border-2 mr-10" placeholder="enter password" type="password"
      id='password' name="password" value=<?= $_POST['password'] ?? null ?>>

  </div>
  <?php if (isset($passwordMessage)) {
      foreach ($passwordMessage as $message) {
        echo "<div>$message</div>";
      }
    }  ?>
  <div class="py-3">
    <input formaction="login" class="mr-10 py-1 px-2 cursor-pointer  border-2 border-emerald-600
       hover:bg-emerald-600 hover:text-white" type="submit" value="Login">
    <input formaction="signup" type="submit" value="Sign up" class="cursor-pointer 
    py-1 px-2 cursor-pointer  border-2
       border-purple-700 hover:bg-purple-700 hover:text-white" href="#"></input>
  </div>
  <?php if ($error ?? null) : ?>
  <span class="text-rose-700">Login or password is wrong</span>
  <?php endif; ?>
</form> <?php } else { ?>
<h1>You have successfully logged in</h1>

<?php } ?>