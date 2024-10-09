<!-- app/views/basket/list.php -->
<h2>Sepetiniz</h2>

<?php if (empty($basketItems)): ?>
    <p>Sepetiniz boş.</p>
<?php else: ?>
    <ul>
        <?php foreach ($basketItems as $item): ?>
            <li><?php echo $item['food_id']; ?> - <?php echo $item['quantity']; ?></li>
            <a href="index.php?page=basket&action=remove&food_id=<?php echo $item['food_id']; ?>">Sepetten çıkar</a>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<a href="index.php?page=coupon&action=apply">Kupon Kodu Kullan</a>
