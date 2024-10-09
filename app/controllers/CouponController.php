<?php
// app/controllers/CouponController.php

require 'app/models/Coupon.php';
require 'config/database.php';

session_start();

class CouponController
{
    public static function applyCoupon()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $couponCode = $_POST['coupon_code'];
            $restaurantId = $_POST['restaurant_id'];

            // Kuponu kontrol et ve indirim oranını al
            $coupon = Coupon::validateCoupon($couponCode, $restaurantId);

            if ($coupon) {
                // İndirim hesapla
                $discount = $coupon['discount'];
                $_SESSION['coupon_discount'] = $discount;
                header('Location: index.php?page=checkout');
            } else {
                $error = "Geçersiz kupon.";
                require 'app/views/coupon/apply.php';
            }
        } else {
            require 'app/views/coupon/apply.php';
        }
    }
}
