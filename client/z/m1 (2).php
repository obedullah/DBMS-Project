<html>
<head>
<title>Sending email using PHP</title>
</head>
<body>
<?php
   $to = "surbhiagg964@gmail.com";
   $subject = "Ticket Booked";
   $message = "Your ticket has been booked.";
   $header = "From:voss.india@gmail.com \r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )  
   {
      echo "Message sent successfully.";
   }
   else
   {
      echo "Message could not be sent.";
   }
?>
</body>
</html>