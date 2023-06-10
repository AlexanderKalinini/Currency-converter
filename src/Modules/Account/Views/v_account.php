<?php if (empty($_SESSION["loggedin"])) return;
echo '<pre>';
print_r($currencies ?? null);
