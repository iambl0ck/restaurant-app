<?php
// app/controllers/OrderController.php

require 'app/models/Order.php';
require 'config/database.php';
require 'app/helpers/mail.php';  // E-posta gönderimi için mail fonksiyonunu dahil ediyoruz

session_start();

class OrderController
{
    // Sipariş oluşturma işlemi
    public static function placeOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $totalPrice = $_POST['total_price'];
            $status = 'pending';  // Sipariş başlangıçta beklemede
            
            if (Order::placeOrder($userId, $totalPrice, $status)) {
                // Sipariş verildi, e-posta bildirimi gönder
                $user = $_SESSION['user'];
                $subject = "Siparişiniz Alındı";
                $message = "Siparişiniz başarıyla alındı. Toplam Tutar: $totalPrice TL. Siparişiniz en kısa sürede hazırlanacaktır.";
                sendEmail($user['email'], $subject, $message);

                header('Location: index.php?page=orders&action=history');
                exit;
            }
        }
    }

    // Sipariş geçmişini göster
    public static function history()
    {
        $userId = $_SESSION['user']['id'];
        $orders = Order::getOrderHistory($userId);
        require 'app/views/orders/history.php';
    }

    // Sipariş detayı gösterme
    public static function view($orderId)
    {
        $order = Order::getById($orderId);
        if ($order) {
            require 'app/views/orders/view.php';
        } else {
            echo "Sipariş bulunamadı.";
        }
    }
}
