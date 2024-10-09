<?php
// app/controllers/PasswordResetController.php

require 'app/models/PasswordReset.php';
require 'app/models/User.php';
require 'config/database.php';
require 'app/helpers/mail.php';  // E-posta gönderimi için mail fonksiyonunu dahil ediyoruz

session_start();

class PasswordResetController
{
    // Şifre sıfırlama isteği
    public static function requestReset()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars(trim($_POST['email']));
            $user = User::getUserByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(50)); // Token oluşturuluyor
                PasswordReset::createResetRequest($user['id'], $token);

                // Şifre sıfırlama e-postası gönder
                $resetLink = "http://localhost/your_project_folder/index.php?page=password_reset&action=reset&token=$token";
                $subject = "Şifre Sıfırlama Talebi";
                $message = "Şifrenizi sıfırlamak için bu bağlantıya tıklayın: <a href='$resetLink'>$resetLink</a>";
                sendEmail($user['email'], $subject, $message);

                echo "Şifre sıfırlama bağlantısı e-posta adresinize gönderildi.";
            } else {
                echo "Bu e-posta adresiyle kayıtlı kullanıcı bulunamadı.";
            }
        } else {
            require 'app/views/password_reset/request.php';
        }
    }

    // Şifre sıfırlama işlemi
    public static function resetPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $password = password_hash(trim($_POST['password']), PASSWORD_ARGON2ID);

            $resetRequest = PasswordReset::getResetRequest($token);

            if ($resetRequest && strtotime($resetRequest['expires_at']) > time()) {
                User::updatePassword($resetRequest['user_id'], $password);
                PasswordReset::deleteResetRequest($resetRequest['id']);

                echo "Şifreniz başarıyla güncellendi.";
            } else {
                echo "Bu şifre sıfırlama bağlantısı geçersiz veya süresi dolmuş.";
            }
        } else if (isset($_GET['token'])) {
            require 'app/views/password_reset/reset.php';
        } else {
            echo "Geçersiz istek.";
        }
    }
}
