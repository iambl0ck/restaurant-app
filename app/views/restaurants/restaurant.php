<!-- app/views/restaurants/restaurant.php -->
<h2><?php echo htmlspecialchars($restaurant['name']); ?></h2>
<p>Konum: <?php echo htmlspecialchars($restaurant['location']); ?></p>
<p>Ortalama Puan: <?php echo Comment::getAverageScore($restaurant['id']); ?> / 5</p>

<h3>Yorumlar</h3>
<?php require 'app/views/comments/list.php'; ?>

<a href="index.php?page=comments&action=add&restaurant_id=<?php echo $restaurant['id']; ?>">Yorum Yap</a>
