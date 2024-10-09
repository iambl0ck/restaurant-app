<?php
// app/controllers/BasketController.php

require 'app/models/Basket.php';
require 'config/database.php';

session_start();

class BasketController
{
    public static function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $foodId = $_POST['food_id'];
            $quantity = $_POST['quantity'];
            $note = $_POST['note'];

            // Sepete ekle
            Basket::addToBasket($userId, $foodId, $quantity, $note);
            header('Location: index.php?page=basket&action=list');
            exit;
        }
    }

    public static function remove()
    {
        if (isset($_GET['food_id'])) {
            $userId = $_SESSION['user']['id'];
            $foodId = $_GET['food_id'];

            // Sepetten çıkar
            Basket::removeFromBasket($userId, $foodId);
            header('Location: index.php?page=basket&action=list');
            exit;
        }
    }

    public static function list()
    {
        $userId = $_SESSION['user']['id'];
        $basketItems = Basket::getBasket($userId);
        require 'app/views/basket/list.php';
    }
}
