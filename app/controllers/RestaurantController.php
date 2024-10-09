<?php
// app/controllers/RestaurantController.php

require 'app/models/Restaurant.php';
require 'config/database.php';

session_start();

class RestaurantController
{
    // Mevcut restoran işlemleri burada bulunuyor
    public static function list()
    {
        $restaurants = Restaurant::getAll();
        require 'app/views/restaurants/list.php';
    }

    // Restoran arama ve filtreleme işlemi
    public static function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : null;
            $location = isset($_GET['location']) ? htmlspecialchars($_GET['location']) : null;
            $cuisine = isset($_GET['cuisine']) ? htmlspecialchars($_GET['cuisine']) : null;

            // Restoranları filtrele
            $restaurants = Restaurant::search($name, $location, $cuisine);
            require 'app/views/restaurants/search_results.php';
        }
    }

    // Diğer restoran kontrolcü metodları (ekle, sil, güncelle gibi)
    public static function add()
    {
        // Yeni restoran ekleme işlemi
    }

    public static function delete()
    {
        // Restoran silme işlemi
    }

    public static function update()
    {
        // Restoran güncelleme işlemi
    }
}
