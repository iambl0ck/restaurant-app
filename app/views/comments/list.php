<!-- app/views/comments/list.php -->
<h2>Yorumlar</h2>

<?php if (empty($comments)): ?>
    <p>Bu restorana henüz yorum yapılmamış.</p>
<?php else: ?>
    <ul>
        <?php foreach ($comments as $comment): ?>
            <li>
                <strong><?php echo htmlspecialchars($comment['description']); ?></strong> -
                Puan: <?php echo htmlspecialchars($comment['score']); ?> / 5
                <em><?php echo htmlspecialchars($comment['created_at']); ?></em>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
