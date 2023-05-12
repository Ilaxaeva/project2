<?php


setcookie('userlogin',$login_view['token'],strtotime('-1 day'),'/');

header('location:index.php');

?>