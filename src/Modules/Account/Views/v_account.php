<?php if (empty($_SESSION["loggedin"])) return;

function result()
{
  if (isset($_POST['curr'])) {
    return (float)$_POST["curr"] * (float)$_POST['amount'];
  }
  return null;
}

$res = result();

?>
<link rel="stylesheet" href="src/Modules/Account/Views/styles.css">
<h1 class="font-bold text-xl mb-5">Валютный калькулятор</h1>
<div class="flex flex-col">
  <div class="flex">
    <span class="converter_title_name mb-5">конвертер валют</span>
  </div>
  <form method="POST">
    <div class="flex">
      <select class="w-60 text-center h-10 border " name="curr" id="df">
        <?php
        foreach ($currencies as $currency) {
          $value = (float)$currency['value'] / $currency['amount'];
          echo $value;

          if ((float)$_POST['curr'] === $value) {
        ?>
            <option selected value=<?= $value ?>> <?= $currency['currency'] ?></option>
          <?php } ?>
          <option value=<?= $value ?>> <?= $currency['currency'] ?></option>
        <?php }
        ?>
      </select>
      <input id='cur' name='amount' class="w-80 h-10 border" step='any' type="number" value=<?= $_POST['amount'] ?? '0' ?>>
    </div>
    <div class="flex mb-5">
      <div class="leading-10 text-center w-60 h-10 border" name="curr" id="df">
        Российский рубль
      </div>
      <input id='rub' step="any" class="w-80 h-10  border " type="number" value=<?= $res ?? 0 ?>>
      <? ?>
    </div>
    <div>
      <input class="border py-2 px-4 cursor-pointer mr-32" type="submit" value="Конвертировать в рубли">
      <input class="border py-2 px-4 cursor-pointer ml-3" value="Конвертация в валюту">
    </div>
  </form>
</div>
<script src="src/Modules/Account/Views/script.js"></script>
<?php

// print_r(gettype((float)$_POST['curr']));