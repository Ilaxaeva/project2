<?php


date_default_timezone_set('Asia/Baku');

// BAZA İLE BAGLANTİ +

try{

$db=new PDO('mysql:host=localhost;dbname=itlc','root','adminadmin');
// echo "DB ugurla baglandi";

}catch(PDOException $e){

    // getCode() - > xeta kodu
    // getMessage() -> xeta mesaji

    echo "Xeta kodu :".$e->getCode();
    echo "<br>Xeta mesaji :".$e->getMessage();

}


// BAZA İLE BAGLANTİ -


?>