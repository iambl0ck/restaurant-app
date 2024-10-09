// config/session.php

ini_set('session.cookie_httponly', 1);  // JavaScript'in cookie'ye erişimini engelle
ini_set('session.cookie_secure', 1);    // Sadece HTTPS üzerinden gönder
session_start();
session_regenerate_id(true);            // Oturum ID'sini yenile
