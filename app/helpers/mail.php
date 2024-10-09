<?php
// app/helpers/mail.php

function sendEmail($to, $subject, $message)
{
    $mailConfig = require 'config/mail.php';
    
    // PHPMailer veya benzeri bir SMTP kütüphanesi kullanarak e-posta gönderimi yapılabilir.
    // Aşağıda PHPMailer örneği verilmiştir. PHPMailer kurulu değilse `mail()` fonksiyonu kullanılabilir.

    $headers = "From: " . $mailConfig['from_name'] . " <" . $mailConfig['from_email'] . ">\r\n";
    $headers .= "Reply-To: " . $mailConfig['from_email'] . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // PHP'nin mail() fonksiyonuyla SMTP üzerinden e-posta gönderimi
    return mail($to, $subject, $message, $headers);
}
