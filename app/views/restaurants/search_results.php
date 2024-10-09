<!-- app/views/restaurants/search_results.php -->
<h2>Arama Sonuçları</h2>

<?php if (empty($restaurants)): ?>
    <p>Hiç restoran bulunamadı.</p>
<?php else: ?>
    <ul>
        <?php foreach ($restaurants as $restaurant): ?>
            <li>
                <strong><?php echo htmlspecialchars($restaurant['name']); ?></strong> - 
                <?php echo htmlspecialchars($restaurant['location']); ?> - 
                <?php echo htmlspecialchars($restaurant['cuisine']); ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<a href="index.php?page=restaurants&action=search">Yeni arama yap</a>
