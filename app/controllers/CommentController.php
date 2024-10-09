<?php
// app/controllers/CommentController.php

require 'app/models/Comment.php';
require 'config/database.php';

session_start();

class CommentController
{
    public static function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'];
            $restaurantId = $_POST['restaurant_id'];
            $description = $_POST['description'];
            $score = $_POST['score'];

            // Yorum ve puan ekle
            Comment::addComment($userId, $restaurantId, $description, $score);
            header('Location: index.php?page=restaurant&id=' . $restaurantId);
            exit;
        }
    }

    public static function list()
    {
        if (isset($_GET['restaurant_id'])) {
            $restaurantId = $_GET['restaurant_id'];
            $comments = Comment::getComments($restaurantId);
            require 'app/views/comments/list.php';
        }
    }
}
