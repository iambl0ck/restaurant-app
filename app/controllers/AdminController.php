<?php
// app/controllers/AdminController.php

require 'app/models/User.php';

session_start();

// Kullanıcı giriş yapmış mı kontrol ediliyor
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=users&action=login');
    exit;
}

// Kullanıcı admin mi kontrol ediliyor
if (!User::isAdmin($_SESSION['user_id'])) {
    echo "Bu sayfaya erişim yetkiniz yok.";
    exit;
}

// Admin paneli gösteriliyor
require 'app/views/admin/dashboard.php';
