<?php
// app/models/Invoice.php

require 'config/database.php';

class Invoice
{
    // Fatura oluşturma
    public static function createInvoice($orderId, $userId, $totalAmount)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO invoices (order_id, user_id, total_amount, invoice_date) VALUES (?, ?, ?, NOW())');
        return $stmt->execute([$orderId, $userId, $totalAmount]);
    }

    // Siparişe göre faturayı almak
    public static function getInvoiceByOrderId($orderId)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT * FROM invoices WHERE order_id = ?');
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
