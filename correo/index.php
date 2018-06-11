<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = "";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = 'robert15001561@gmail.com';
$mail->Password = '15001561';

$mail->setFrom('becerracervantes33@gmail.com', 'Senaid Bacinovic');
$mail->addAddress('becerracervantes33@gmail.com');
$mail->Subject = 'SMTP email test';
$mail->Body = 'this is some body';

if ($mail->send())
    echo "Mail sent";
?>
