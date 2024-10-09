<?php
// app/models/Restaurant.php

require 'config/database.php';

class Restaurant
{
    // Tüm restoranları listele
    public static function getAll()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT * FROM restaurant');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Restoran arama ve filtreleme işlemi
    public static function search($name, $location, $cuisine)
    {
        global $pdo;

        $query = 'SELECT * FROM restaurant WHERE 1=1';  // Dinamik filtreleme için başlangıç noktası
        $params = [];

        // Eğer isim filtresi varsa
        if ($name) {
            $query .= ' AND name LIKE ?';
            $params[] = '%' . $name . '%';
        }

        // Eğer konum filtresi varsa
        if ($location) {
            $query .= ' AND location = ?';
            $params[] = $location;
        }

        // Eğer mutfak türü filtresi varsa
        if ($cuisine) {
            $query .= ' AND cuisine = ?';
            $params[] = $cuisine;
        }

        // Sorguyu hazırla ve çalıştır
        $stmt = $pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Diğer restoran metodları (ekle, sil, güncelle gibi)
    public static function add($name, $description, $location, $cuisine)
    {
        global $pdo;
        $stmt = $pdo->prepare('INSERT INTO restaurant (name, description, location, cuisine, created_at) VALUES (?, ?, ?, ?, NOW())');
        return $stmt->execute([$name, $description, $location, $cuisine]);
    }

    public static function update($id, $name, $description, $location, $cuisine)
    {
        global $pdo;
        $stmt = $pdo->prepare('UPDATE restaurant SET name = ?, description = ?, location = ?, cuisine = ? WHERE id = ?');
        return $stmt->execute([$name, $description, $location, $cuisine, $id]);
    }

    public static function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM restaurant WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
