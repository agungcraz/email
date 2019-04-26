<?php
$nama = $_GET['nama'];
$email = $_GET['email'];
$kodeVerifikasi= $_GET['kodeVerifikasi'];
$html = file_get_contents('email-template.html');
$html = str_replace('{ nama }',$nama,$html);
/* Namespace alias. */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'plugin/PHPMailer-master/src/Exception.php';
require 'plugin/PHPMailer-master/src/PHPMailer.php';
require 'plugin/PHPMailer-master/src/SMTP.php';

/* If you installed PHPMailer without Composer do this instead: */
/*
require 'C:\PHPMailer\src\Exception.php';
require 'C:\PHPMailer\src\PHPMailer.php';
require 'C:\PHPMailer\src\SMTP.php';
*/

/* Create a new PHPMailer object. Passing TRUE to the constructor enables exceptions. */
$mail = new PHPMailer(TRUE);

/* Open the try/catch block. */
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';

    /* Username (email address). */
    $mail->Username = 'craz.devteam@gmail.com';

    /* Google account password. */
    $mail->Password = 'grxulwagpvplkezk';

    /* Set the mail sender. */
    $mail->setFrom('craz.devteam@gmail.com', 'WAPRON.ID');
// craz.devteam@gmail.com
// 562015018@student.uksw.edu
    /* Add a recipient. */
    $mail->addAddress($email, $nama);

    /* Set the subject. */
    $mail->Subject = date('H:i:s - d/m/Y');

    /* Set the mail message body. */
    $mail->Body = $html;

    $mail->isHTML(true);

    /* Finally send the mail. */
    $mail->send();
}
catch (Exception $e)
{
    /* PHPMailer exception. */
    echo $e->errorMessage();
}
catch (\Exception $e)
{
    /* PHP exception (note the backslash to select the global namespace Exception class). */
    echo $e->getMessage();
}
