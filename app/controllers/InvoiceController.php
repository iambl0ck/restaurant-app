<?php
// app/controllers/InvoiceController.php

require 'app/models/Invoice.php';
require 'config/database.php';

session_start();

class InvoiceController
{
    // Siparişe bağlı olarak fatura oluştur
    public static function generateInvoice($orderId)
    {
        $order = Order::getById($orderId);
        $userId = $_SESSION['user']['id'];

        if ($order) {
            // Fatura oluştur
            if (Invoice::createInvoice($orderId, $userId, $order['total_price'])) {
                header('Location: index.php?page=invoice&action=view&orderId=' . $orderId);
                exit;
            } else {
                echo "Fatura oluşturulamadı.";
            }
        } else {
            echo "Geçersiz sipariş ID.";
        }
    }

    // Faturayı görüntüle
    public static function viewInvoice($orderId)
    {
        $invoice = Invoice::getInvoiceByOrderId($orderId);
        if ($invoice) {
            require 'app/views/invoices/view.php';
        } else {
            echo "Fatura bulunamadı.";
        }
    }
}
