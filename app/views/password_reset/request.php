<!-- app/views/password_reset/request.php -->
<h2>Şifre Sıfırlama</h2>

<form action="index.php?page=password_reset&action=request" method="POST">
    <label for="email">E-posta Adresi:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Şifre Sıfırlama Bağlantısı Gönder</button>
</form>
