<?php

 require('db_conn.php');

 use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 function sendMail($email_id,$reset_token)
 {
require('PHPMailer/PHPMailer.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/Exception.php');

$mail = new PHPMailer(true);

try {
    //Server settings
                         //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nithinkamath111@gmail.com';                     //SMTP username
    $mail->Password   = 'ccox sihp qsgu rlmc';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('nithinkamath111@gmail.com', 'Mailer');
    $mail->addAddress($email_id);     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password reset link';
    $mail->Body    = "We got a request from you to reset password! <br>
    Click the link below:<br>
    <a href='http://localhost/app/updatepassword.php?email=$email_id&reset_token=$reset_token'>Reset Password</a>";
   

    $mail->send();
    return true;
} catch (Exception $e) {
    return false;
}
 }
 if(isset($_POST['send-reset-link'])){
   $query="SELECT * FROM `users` WHERE `email_id`='$_POST[email]'";
   $result=mysqli_query($connection,$query);
   if($result){
if(mysqli_num_rows($result)==1){
$reset_token=bin2hex(random_bytes(16));
date_default_timezone_set('Asia/kolkata');
$date=date("Y-m-d");
$query=" UPDATE `users` SET `resettoken`='$reset_token',`resettokenexpire`='$date' WHERE `email_id`='$_POST[email]'";
if(mysqli_query($connection,$query) && sendMail($_POST['email'],$reset_token)){
    echo "<script>
    alert('Password reset link sent to mail');
    window.location.href='index.php';
    </script>";
}else{
    echo "<script>
    alert('Server down!try again later');
    window.location.href='index.php';
    </script>";
}
}
else{
    echo "<script>
    alert('Email not found');
    window.location.href='index.php';
    </script>";
}
   }else{
    echo "<scipt>
    alert('cannot run query');
    window.location.href='index.php';
    </scipt>";
   }
 }

?>