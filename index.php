<?php
session_start();

// Gelen URL'deki 'page' parametresine göre sayfa yükleyelim
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Ortak header dosyasını dahil edelim (örn: navbar ve diğer genel yapılar için)
require 'app/views/header.php';

// Sayfa yönlendirme
switch ($page) {
    case 'home':
        require 'app/views/home.php';
        break;

    case 'login':
        require 'app/views/users/login.php';
        break;

    case 'register':
        require 'app/views/users/register.php';
        break;

    case 'restaurants':
        require 'app/views/restaurants/list.php';
        break;

    case 'profile':
        require 'app/views/users/profile.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: index.php?page=login');
        break;

    default:
        echo "Sayfa bulunamadı!";
        break;
}

// Ortak footer dosyasını dahil edelim (örn: sayfa sonu yapıları)
require 'app/views/footer.php';
