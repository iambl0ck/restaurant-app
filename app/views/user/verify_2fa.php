<!-- app/views/user/verify_2fa.php -->
<h2>İki Faktörlü Doğrulama</h2>

<form action="index.php?page=user&action=verify_2fa" method="POST">
    <label for="two_factor_code">Doğrulama Kodu:</label>
    <input type="text" id="two_factor_code" name="two_factor_code" required>
    <button type="submit">Doğrula</button>
</form>
