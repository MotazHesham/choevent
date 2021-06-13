<?php

namespace App\Traits;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
trait SendEmailTrait{

function send_email($to, $message, $subject, $attach = null, $file_name = '')
    {

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server Settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->CharSet = 'UTF-8';
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'moalenapp@gmail.com';                 // SMTP username
            $mail->Password = 'hwgrcuszvdeycvka';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            //Recipients
            $mail->setFrom('no_replay@Mo3len.com', 'Mo3len App.');
            foreach ($to as $item) {
                $mail->addAddress($item, 'Mo3len');     // Add a recipient
            }
            $body = $message;
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $body;

            //add attachment
            if ($attach != null) {
                $mail->addAttachment($attach, $file_name);
            }

            return $mail->send();

        } catch (Exception $e) {
//                echo 'Message could not be sent.';
            return 'Mailer Error: ' . $mail->ErrorInfo;
        }


    }
}