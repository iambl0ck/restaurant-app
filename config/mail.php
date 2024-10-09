<?php
// config/mail.php

return [
    'smtp_host' => 'smtp.example.com',  // SMTP sunucusu
    'smtp_port' => 587,                 // SMTP portu
    'smtp_user' => 'your-email@example.com',  // SMTP kullanıcı adı
    'smtp_pass' => 'your-password',     // SMTP şifresi
    'smtp_secure' => 'tls',             // Güvenlik türü (ssl veya tls)
    'from_email' => 'no-reply@example.com',   // Gönderen e-posta adresi
    'from_name' => 'Restoran Yönetimi',  // Gönderen adı
];
