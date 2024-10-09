<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restoran Ekle</title>
</head>
<body>
    <h1>Yeni Restoran Ekle</h1>
    <?php if (isset($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form action="index.php?page=restaurants&action=add" method="POST">
        <label for="name">Restoran Adı:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="description">Açıklama:</label>
        <textarea id="description" name="description" required></textarea><br><br>
        <button type="submit">Ekle</button>
    </form>
    <a href="index.php?page=restaurants">Geri Dön</a>
</body>
</html>
