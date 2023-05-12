<meta charset="UTF-8">
<?php

$token=md5(sha1(base64_encode(random_bytes(5).uniqid(10).date('ymdhis').rand())));

echo $token;

?>