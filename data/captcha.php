<?php
session_start();
function randomText($length) {
//    $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";
    $pattern = "23456789aBcDefghjkLmnPQrstuVwxyz";
    for($i=0;$i<$length;$i++) {
      $key1 = $pattern{rand(0,31)};
      $key2 = $pattern{rand(0,31)};
      $key3 = $pattern{rand(0,31)};
      $key4 = $pattern{rand(0,31)};
      $key5 = $pattern{rand(0,31)};
    }
    $key = $key1.$key2.$key3.$key4.$key5;
    return $key;
}
$_SESSION['tmptxt'] = randomText(1);
$captcha = imagecreatefromgif("../img/bgcaptcha.gif");
$colText = imagecolorallocate($captcha, 0, 0, 0);
imagestring($captcha, 5, 16, 7, $_SESSION['tmptxt'], $colText);

//header("Content-type: image/gif");
imagegif($captcha);
?>
