<?php
include('SMTPconfig.php');
include('SMTPClass.php');
//if($_SERVER["REQUEST_METHOD"] == "POST")
{
$to = $_POST['to'];
$from = $_POST['from'];
$subject = $_POST['sub'];
$body = $_POST['message'];
$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
$SMTPChat = $SMTPMail->SendMail();


   $to = "surbhiagg964@gmail.com";
   $from = "voss.india@gmail.com";
   $subject = "Ticket Booked";
   $body = "Your ticket has been booked.";
   $SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
   $SMTPChat = $SMTPMail->SendMail();
   //$header = "From:voss.india@gmail.com \r\n";
   /*$retval = mail ($to,$subject,$message,$header);
   if( $retval == true )  
   {
      echo "Message sent successfully.";
   }
   else
   {
      echo "Message could not be sent.";
   }*/
}
?>
