<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siparişler</title>
</head>
<body>
    <h1>Siparişler</h1>
    <ul>
        <?php foreach ($orders as $order): ?>
            <li>
                Sipariş No: <?php echo htmlspecialchars($order['id']); ?> - 
                Toplam Fiyat: <?php echo htmlspecialchars($order['total_price']); ?> - 
                Durum: <?php echo htmlspecialchars($order['order_status']); ?>
                <a href="index.php?page=orders&action=edit&id=<?php echo $order['id']; ?>">Düzenle</a>
                <a href="index.php?page=orders&action=delete&id=<?php echo $order['id']; ?>" onclick="return confirm('Bu siparişi silmek istediğinize emin misiniz?');">Sil</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
