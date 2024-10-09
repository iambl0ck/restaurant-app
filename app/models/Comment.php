<?php
// app/models/Comment.php

require 'config/database.php';

class Comment
{
    public static function addComment($userId, $restaurantId, $description, $score)
    {
        global $pdo;
        // Yorum ve puan ekle
        $stmt = $pdo->prepare('INSERT INTO comments (user_id, restaurant_id, description, score, created_at) VALUES (?, ?, ?, ?, NOW())');
        return $stmt->execute([$userId, $restaurantId, $description, $score]);
    }

    public static function getComments($restaurantId)
    {
        global $pdo;
        // Restoranın tüm yorumlarını al
        $stmt = $pdo->prepare('SELECT * FROM comments WHERE restaurant_id = ?');
        $stmt->execute([$restaurantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAverageScore($restaurantId)
    {
        global $pdo;
        // Restoranın ortalama puanını hesapla
        $stmt = $pdo->prepare('SELECT AVG(score) as average_score FROM comments WHERE restaurant_id = ?');
        $stmt->execute([$restaurantId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average_score'];
    }
}
