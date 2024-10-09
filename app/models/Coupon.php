<?php
// app/models/Coupon.php

require 'config/database.php';

class Coupon
{
    public static function validateCoupon($couponCode, $restaurantId)
    {
        global $pdo;
        // Kuponun geçerliliğini kontrol et
        $stmt = $pdo->prepare('SELECT * FROM coupon WHERE name = ? AND restaurant_id = ?');
        $stmt->execute([$couponCode, $restaurantId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
