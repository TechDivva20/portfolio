<?php
require '../../config/mail.php';

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$firstName = $_POST["firstName"];
$lastName = $_POST["lastName"];
$name = $firstName . ' ' . $lastName;

$from = $_POST["email"];

$address = $_POST["address"];
$phone = $_POST["phone"];
$car = $_POST["car"];
$years = $_POST["years"];
$bank = $_POST["bank"];

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
    $mail->AddReplyTo($from, $name);
    $mail->setFrom(SMTP_USERNAME, $name);
    $mail->addAddress('madgesiversonhjk29@gmail.com', 'Robert Winery'); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = "ROBERT WINERY PORTFOLIO";
    $mail->Body = "<h5>Contact by $name</h5>
                    <p> email: $from<br>
                    address: $address<br>
                    phone: $phone<br>
                    car: $car<br>
                    years: $years<br>
                    bank: $bank
                    </p>";
    $mail->AltBody = " Contact by $name ,
                    email: $from,
                    address: $address,
                    phone: $phone,
                    car: $car,
                    years: $years,
                    bank: $bank
                    ";

    $mail->send();
    header('Location: ../index.html?sent');
} catch (Exception $e) {
    header('Location: ../index.html?error');
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>