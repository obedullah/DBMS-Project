<html>
<head>
<title>Sending HTML email using PHP</title>
</head>
<body>
<?php
   $to = "surbhiagg964@somedomain.com";
   $subject = "This is subject";
   $message = "<b>This is HTML message.</b>";
   $message .= "<h1>This is headline.</h1>";
   $header = "From:voss.india@gmail.com \r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
?>
</body>
</html>