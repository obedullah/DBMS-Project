<?php require("../PHPMailer/class.phpmailer.php"); ?>

<?php
//this is another function i have in my function.php

$st_email ="surbhiagg964@gmail.com";

$mail = new PHPMailer(true);
$mail->PluginDir = './';
$mail->IsSMTP();
$mail->Port = 465;
$mail->Host = "smtp.gmail.com"; 
$mail->IsHTML(true); 
$mail->Mailer = "smtp";
$mail->SMTPSecure = "ssl";

$mail->SMTPAuth = true;
$mail->Username = "voss.india@gmail.com";
$mail->Password = "vosstravels123";

$mail->SingleTo = true; // if you want to send mail to the users individually so that no recipients can see that who has got the same email.

$mail->From = "voss.india@gmail.com";
$mail->FromName = "myweb.com";

$mail->addAddress($st_email);

$mail->Subject = "test";
$mail->Body = "Hi,This system is working perfectly.";

if(!$mail->Send())
echo "Message was not sent PHP Mailer Error: " . $mail->ErrorInfo;
else
echo "Message has been sent";
?>