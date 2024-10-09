<?php
// app/models/PasswordReset.php

require 'config/database.php';

class PasswordReset
{
    public static function createResetRequest($userId, $token)
    {
        global $pdo;
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $stmt = $pdo->prepare('INSERT INTO password_resets (user_id, token, expires_at) VALUES (?, ?, ?)');
        return $stmt->execute([$userId, $token, $expiresAt]);
    }

    public static function getResetRequest($token)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM password_resets WHERE token = ?');
        $stmt->execute([$token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function deleteResetRequest($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM password_resets WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
