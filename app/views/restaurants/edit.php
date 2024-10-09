<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Düzenle</title>
</head>
<body>
    <h1>Restoran Düzenle</h1>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="index.php?page=restaurants&action=edit&id=<?php echo $restaurant['id']; ?>" method="POST">
        <label for="name">Restoran Adı:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($restaurant['name']); ?>" required><br><br>
        <label for="description">Açıklama:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($restaurant['description']); ?></textarea><br><br>
        <button type="submit">Güncelle</button>
    </form>
    <a href="index.php?page=restaurants">Geri Dön</a>
</body>
</html>
