<?php

require '../vendor/PHPMailer-master/src/PHPMailer.php';
require '../vendor/PHPMailer-master/src/SMTP.php';
require '../vendor/PHPMailer-master/src/Exception.php';
require 'config.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$name = $_POST["name"];
$from = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];
$to = "akinyemisamuel170@gmail.com";

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USERNAME;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = SMTP_PORT; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("$from", "$name");
    $mail->addAddress("$to"); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = "$subject";
    $mail->Body = "$message";
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'OK';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>