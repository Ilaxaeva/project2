<?php
include 'config.php';


// QEYDİYYAT BOLMESİ +++++++++++++++

if (isset($_POST['name'])) {

/*

shas1
base64
md5 -  qirilamagi en cetin olandir

*/
$token=md5(sha1(base64_encode(random_bytes(5).uniqid(10).'Test project'.date('ymdhis').rand())));



    $add_user = $db->prepare('INSERT into user set
name=:name,
email=:email,
token=:token,
date=:date,
password=:password
');
    $add_user->execute(
        array(
            'name' => $_POST['name'],
            'email' => strip_tags($_POST['email']),
            'token' => $token,
            'date'=>date('Y-m-d H:i:s'),
            'password' => md5($_POST['password'])
        )
    );


    if ($add_user) {
        header('location:../index.php?reg=ok');
    } else {
        header('location:register.php');
    }


}



// QEYDİYYAT BOLMESİ +++++++++++++++


// LOGİN BOLMESİ +++++++++++++++

if (isset($_POST['pass'])) {


    $login_scan = $db->prepare("SELECT * from user where
    email=:email and password=:password
    ");

    $login_scan->execute(
        array(
            "email" => $_POST['mail'],
            "password" =>md5($_POST['pass'])
        )
    );



    $login_check = $login_scan->rowCount();

    $login_view=$login_scan->fetch(PDO::FETCH_ASSOC);



    if ($login_check == 1) {



    setcookie('userlogin',$login_view['token'],strtotime('+1 day'),'/');

        header('location:../panel.php');






    } else {



        header('location:../index.php?login=no');



    }

}

// LOGİN BOLMESİ +++++++++++++++



// SİFRE YENİLEME BOLMESİ +++++++++++++++


if(isset($_POST['forgot_pass'])){

$mail_scan=$db->prepare('SELECT * from user where email=:email');
$mail_scan->execute(array(
"email"=>$_POST['forgot_pass']
));

$mail_count=$mail_scan->rowCount();

if($mail_count==0){
    header('location:../forgot-password.php?error=no');
}else{

$new_pass=substr(md5(date('y-m-dhis').rand()),0,6);

$update_pass=$db->prepare("UPDATE user set password=:password
 where email=:email ");

$update_pass->execute(array(
  "password"=>$new_pass,
  "email"=>$_POST['forgot_pass']
));


$mesaj="Salam sizin yeni parolunuz :".$new_pass;
require("phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug = 1; 
$mail->SMTPAuth = true; 
$mail->SMTPSecure = 'tls'; 
$mail->Host = "zeynalov.net"; // Mail Server
$mail->Port = 587;
$mail->IsHTML(true);
$mail->SetLanguage("az", "language");
$mail->CharSet = "utf-8";
$mail->Username = "test@zeynalov.net"; // Mail
$mail->Password = "]fMjhBpVQe5["; // Mail parol
$mail->SetFrom("test@zeynalov.net", "Project ITLC");
$mail->AddAddress($_POST['forgot_pass']); // Gönderilecek mail
$mail->Subject = "Parol Yenilemek"; // BAŞLIQ
$mail->Body = $mesaj; // Mesaj
if (!$mail->Send()) {
	echo "Email Gönderim Hatasi: " . $mail->ErrorInfo;
} else {
    header('location:../forgot-password.php?error=yes');
}






}




}



if(isset($_GET['sil'])){


$user_sil=$db->prepare('DELETE FROM    user where id=:id');
$user_sil->execute(array(
"id"=>$_GET['sil']

));



header('location:../users.php');




}


?>