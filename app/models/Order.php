<?php
// app/models/Order.php

require 'config/database.php';  // PDO bağlantısını dahil ediyoruz

class Order
{
    // Tüm siparişleri almak
    public static function getAll()
    {
        global $pdo;  // PDO bağlantısını kullanıyoruz
        $stmt = $pdo->query('SELECT * FROM orders');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Belirli bir siparişi ID ile almak
    public static function getById($id)
    {
        global $pdo;  // PDO bağlantısını kullanıyoruz
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE id = ?');
        $stmt->execute([(int)$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Yeni sipariş eklemek
    public static function add($userId, $totalPrice, $status)
    {
        global $pdo;  // PDO bağlantısını kullanıyoruz
        $stmt = $pdo->prepare('INSERT INTO orders (user_id, total_price, order_status, created_at) VALUES (?, ?, ?, NOW())');
        return $stmt->execute([$userId, $totalPrice, $status]);
    }

    // Sipariş durumunu güncellemek
    public static function updateStatus($id, $status)
    {
        global $pdo;  // PDO bağlantısını kullanıyoruz
        $stmt = $pdo->prepare('UPDATE orders SET order_status = ? WHERE id = ?');
        return $stmt->execute([$status, (int)$id]);
    }

    // Siparişi silmek
    public static function delete($id)
    {
        global $pdo;  // PDO bağlantısını kullanıyoruz
        $stmt = $pdo->prepare('DELETE FROM orders WHERE id = ?');
        return $stmt->execute([(int)$id]);
    }

    // Sipariş oluşturma (placeOrder)
    public static function placeOrder($userId, $totalPrice, $status)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO orders (user_id, total_price, order_status, created_at) VALUES (?, ?, ?, NOW())');
        return $stmt->execute([$userId, $totalPrice, $status]);
    }

    // Kullanıcıya ait sipariş geçmişini almak (getOrderHistory)
    public static function getOrderHistory($userId)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC');
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
