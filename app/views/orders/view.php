<!-- app/views/orders/view.php -->
<h2>Sipariş Detayı</h2>

<p>Sipariş No: <?php echo htmlspecialchars($order['id']); ?></p>
<p>Tutar: <?php echo htmlspecialchars($order['total_price']); ?> TL</p>
<p>Durum: <?php echo htmlspecialchars($order['order_status']); ?></p>
<p>Oluşturulma Tarihi: <?php echo htmlspecialchars($order['created_at']); ?></p>

<a href="index.php?page=orders&action=history">Sipariş Geçmişine Dön</a>
