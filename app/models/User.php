<?php
// app/models/User.php

require 'config/database.php';

class User
{
    // Kullanıcıyı giriş yapmak için kontrol et
    public static function login($username, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT id, username, password, role, email, two_factor_verified FROM users WHERE username = ?');
        $stmt->execute([htmlspecialchars($username, ENT_QUOTES, 'UTF-8')]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Kullanıcıyı ID ile veritabanından almak için getById fonksiyonu
    public static function getById($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
        $stmt->execute([(int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kullanıcının şifresini güncelle
    public static function updatePassword($userId, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE id = ?');
        return $stmt->execute([$password, $userId]);
    }

    // İki faktörlü doğrulama kodunu ayarla
    public static function setTwoFactorCode($userId, $code)
    {
        global $pdo;
        $expiresAt = (new DateTime())->modify('+10 minutes')->format('Y-m-d H:i:s');
        $stmt = $pdo->prepare('UPDATE users SET two_factor_code = ?, two_factor_expires_at = ?, two_factor_verified = 0 WHERE id = ?');
        return $stmt->execute([$code, $expiresAt, $userId]);
    }

    // İki faktörlü doğrulama kodunu kontrol et
    public static function verifyTwoFactorCode($userId, $code)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT two_factor_code, two_factor_expires_at FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['two_factor_code'] === $code && strtotime($user['two_factor_expires_at']) > time()) {
            $stmt = $pdo->prepare('UPDATE users SET two_factor_verified = 1 WHERE id = ?');
            return $stmt->execute([$userId]);
        }
        return false;
    }

    // Kullanıcıyı kayıt etmek
    public static function register($name, $surname, $username, $password, $role = 'user')
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO users (name, surname, username, password, role, created_at) VALUES (?, ?, ?, ?, ?, NOW())');
        return $stmt->execute([
            htmlspecialchars($name, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($surname, ENT_QUOTES, 'UTF-8'),
            htmlspecialchars($username, ENT_QUOTES, 'UTF-8'),
            $password,
            $role
        ]);
    }

    // Kullanıcının admin olup olmadığını kontrol et
    public static function isAdmin($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT role FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user && $user['role'] === 'admin';
    }

    // Kullanıcının restoran sahibi olup olmadığını kontrol et
    public static function isOwner($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT role FROM users WHERE id = ?');
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user && $user['role'] === 'owner';
    }

    // Kullanıcıyı email ile getir
    public static function getUserByEmail($email)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kullanıcı profilini güncelle
    public static function updateProfile($userId, $name, $surname, $email, $password = null)
    {
        global $pdo;

        if ($password) {
            $stmt = $pdo->prepare('UPDATE users SET name = ?, surname = ?, email = ?, password = ? WHERE id = ?');
            return $stmt->execute([$name, $surname, $email, $password, $userId]);
        } else {
            $stmt = $pdo->prepare('UPDATE users SET name = ?, surname = ?, email = ? WHERE id = ?');
            return $stmt->execute([$name, $surname, $email, $userId]);
        }
    }
}
