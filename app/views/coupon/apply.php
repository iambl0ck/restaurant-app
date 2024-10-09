<!-- app/views/coupon/apply.php -->
<h2>Kupon Kodu Kullan</h2>

<form action="index.php?page=coupon&action=apply" method="POST">
    <label for="coupon_code">Kupon Kodu:</label>
    <input type="text" id="coupon_code" name="coupon_code" required><br>

    <input type="hidden" name="restaurant_id" value="<?php echo $restaurantId; ?>">
    
    <button type="submit">Kuponu Uygula</button>
</form>

<?php if (isset($error)): ?>
    <p><?php echo $error; ?></p>
<?php endif; ?>
