<?php
// app/models/Basket.php

require 'config/database.php';

class Basket
{
    public static function addToBasket($userId, $foodId, $quantity, $note)
    {
        global $pdo;
        // Sepete yemek ekle
        $stmt = $pdo->prepare('INSERT INTO basket (user_id, food_id, quantity, note, created_at) VALUES (?, ?, ?, ?, NOW())');
        return $stmt->execute([$userId, $foodId, $quantity, $note]);
    }

    public static function removeFromBasket($userId, $foodId)
    {
        global $pdo;
        // Sepetten yemek çıkar
        $stmt = $pdo->prepare('DELETE FROM basket WHERE user_id = ? AND food_id = ?');
        return $stmt->execute([$userId, $foodId]);
    }

    public static function getBasket($userId)
    {
        global $pdo;
        // Kullanıcının sepetindeki tüm yemekleri al
        $stmt = $pdo->prepare('SELECT * FROM basket WHERE user_id = ?');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
