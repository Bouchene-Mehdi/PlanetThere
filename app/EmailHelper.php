<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ .'/PhpMailer/PHPMailer.php';
require_once __DIR__ .'/PhpMailer/SMTP.php';
require_once __DIR__ .'/PhpMailer/Exception.php';

class EmailHelper
{

    public static function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'planet.there.mail@gmail.com'; // Replace with your email
            $mail->Password = 'jnjc hril zfad ttnu';   // Replace with your app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('planet.there.mail@gmail.com', 'Planet There'); // Replace with your sender email and name
            $mail->addAddress($to);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return "Email could not be sent. Error: {$mail->ErrorInfo}";
        }
    }
}
