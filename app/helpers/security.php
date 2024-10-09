<?php
// app/helpers/security.php

// CSRF token oluşturma
function generate_csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));  // Güçlü rastgele token oluştur
    }
    return $_SESSION['csrf_token'];
}

// CSRF token kontrol etme
function verify_csrf_token($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
