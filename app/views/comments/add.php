<!-- app/views/comments/add.php -->
<h2>Yorum Yap</h2>

<form action="index.php?page=comments&action=add" method="POST">
    <input type="hidden" name="restaurant_id" value="<?php echo $restaurantId; ?>">

    <label for="description">Yorum:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="score">Puan (1-5):</label>
    <input type="number" id="score" name="score" min="1" max="5" required><br>

    <button type="submit">Yorumu Gönder</button>
</form>
