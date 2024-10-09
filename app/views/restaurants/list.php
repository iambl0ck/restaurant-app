<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoranlar</title>
</head>
<body>
    <h1>Restoranlar</h1>
    <a href="index.php?page=restaurants&action=add">Yeni Restoran Ekle</a>
    <ul>
        <?php foreach ($restaurants as $restaurant): ?>
            <li>
                <strong><?php echo htmlspecialchars($restaurant['name']); ?></strong> -
                <?php echo htmlspecialchars($restaurant['description']); ?>
                <a href="index.php?page=restaurants&action=edit&id=<?php echo $restaurant['id']; ?>">Düzenle</a>
                <a href="index.php?page=restaurants&action=delete&id=<?php echo $restaurant['id']; ?>" onclick="return confirm('Bu restoranı silmek istediğinize emin misiniz?');">Sil</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
