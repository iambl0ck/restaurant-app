<?php
// app/controllers/UserController.php

require 'app/models/User.php';
require 'config/database.php';
require 'app/helpers/security.php';
require 'app/helpers/mail.php';  // E-posta fonksiyonunu dahil ediyoruz

session_start();

// Hatalı giriş denemelerini izlemek için oturumda bir sayaç tutalım
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Eğer kullanıcı oturum açmamışsa, çerezdeki kullanıcıyı kontrol edelim
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_me'])) {
    $user = User::getById($_COOKIE['remember_me']);
    if ($user) {
        $_SESSION['user'] = $user;
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action) {
    case 'login':  // Giriş işlemi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_SESSION['login_attempts'] >= 3) {
                die("Çok fazla hatalı giriş denemesi. Lütfen birkaç dakika sonra tekrar deneyin.");
            }

            if (!verify_csrf_token($_POST['csrf_token'])) {
                die("Geçersiz CSRF token.");
            }

            $username = htmlspecialchars(trim($_POST['username']));
            $password = trim($_POST['password']);
            $rememberMe = isset($_POST['remember_me']);  // Beni Hatırla seçeneğini kontrol et
            
            $user = User::login($username, $password);
            
            if ($user && password_verify($password, $user['password'])) {
                // Oturum ID'sini güvenli bir şekilde yenile
                session_regenerate_id(true);

                // Eğer "Beni Hatırla" seçeneği işaretlenmişse, uzun süreli çerez oluştur
                if ($rememberMe) {
                    setcookie('remember_me', $user['id'], time() + (86400 * 30), "/"); // 30 gün
                }

                // İki Faktörlü Doğrulama Gerekiyor mu?
                if (!$user['two_factor_verified']) {
                    $twoFactorCode = random_int(100000, 999999); // 6 haneli kod üret
                    User::setTwoFactorCode($user['id'], $twoFactorCode);

                    // İki faktörlü doğrulama kodunu e-posta ile gönder
                    mail($user['email'], "İki Faktörlü Doğrulama Kodu", "Doğrulama kodunuz: $twoFactorCode");

                    $_SESSION['user'] = $user; // Kullanıcı bilgilerini oturumda geçici olarak sakla
                    header('Location: index.php?page=user&action=verify_2fa');
                    exit;
                } else {
                    $_SESSION['user'] = $user;  // Kullanıcı doğrulandı
                    $_SESSION['login_attempts'] = 0;  // Başarılı girişte denemeler sıfırlanır
                    header('Location: index.php');  // Ana sayfaya yönlendir
                    exit;
                }
            } else {
                $_SESSION['login_attempts'] += 1;  // Başarısız giriş denemesi arttırılır
                $error = "Geçersiz kullanıcı adı veya şifre.";
                require 'app/views/users/login.php';
            }
        } else {
            require 'app/views/users/login.php';
        }
        break;

    case 'register':  // Kayıt işlemi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verify_csrf_token($_POST['csrf_token'])) {
                die("Geçersiz CSRF token.");
            }

            $name = htmlspecialchars(trim($_POST['name']));
            $surname = htmlspecialchars(trim($_POST['surname']));
            $username = htmlspecialchars(trim($_POST['username']));
            $password = password_hash(trim($_POST['password']), PASSWORD_ARGON2ID);
            $role = (User::isAdmin($_SESSION['user']['id']) && isset($_POST['role'])) ? $_POST['role'] : 'user';
            
            if (!empty($name) && !empty($surname) && !empty($username) && !empty($password)) {
                if (User::register($name, $surname, $username, $password, $role)) {
                    // Kayıt işlemi başarılı, e-posta bildirimi gönder
                    $subject = "Hesabınız Başarıyla Oluşturuldu!";
                    $message = "Merhaba $name, hesabınız başarıyla oluşturulmuştur. Giriş yapmak için kullanıcı adınızı kullanabilirsiniz.";
                    sendEmail($username, $subject, $message);

                    header('Location: index.php?page=users&action=login');
                    exit;
                }
            } else {
                $error = "Lütfen tüm alanları doldurun.";
                require 'app/views/users/register.php';
            }
        } else {
            require 'app/views/users/register.php';
        }
        break;

    case 'logout':  // Çıkış işlemi
        session_destroy();
        setcookie('remember_me', '', time() - 3600, "/");  // Çıkışta çerezi sil
        header('Location: index.php');
        exit;

    case 'verify_2fa':  // İki Faktörlü Doğrulama Kodu Kontrolü
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $twoFactorCode = trim($_POST['two_factor_code']);

            if (User::verifyTwoFactorCode($userId, $twoFactorCode)) {
                // İki faktörlü doğrulama başarılı
                $_SESSION['user']['two_factor_verified'] = true;
                header('Location: index.php');
                exit;
            } else {
                $error = "Geçersiz doğrulama kodu.";
                require 'app/views/user/verify_2fa.php';
            }
        } else {
            require 'app/views/user/verify_2fa.php';
        }
        break;

    case 'profile':  // Profil bilgilerini güncelle
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!verify_csrf_token($_POST['csrf_token'])) {
                die("Geçersiz CSRF token.");
            }

            $userId = $_SESSION['user']['id'];
            $name = htmlspecialchars(trim($_POST['name']));
            $surname = htmlspecialchars(trim($_POST['surname']));
            $email = htmlspecialchars(trim($_POST['email']));
            $password = !empty($_POST['password']) ? password_hash(trim($_POST['password']), PASSWORD_ARGON2ID) : null;

            // Profil bilgilerini güncelle
            if (User::updateProfile($userId, $name, $surname, $email, $password)) {
                $_SESSION['user']['name'] = $name;
                $_SESSION['user']['surname'] = $surname;
                $_SESSION['user']['email'] = $email;
                echo "Profiliniz başarıyla güncellendi.";
                header('Location: index.php?page=user&action=profile');
                exit;
            } else {
                echo "Profil güncelleme başarısız.";
            }
        } else {
            require 'app/views/users/profile.php';
        }
        break;

    default:
        echo "Geçersiz işlem.";
        exit;
}
