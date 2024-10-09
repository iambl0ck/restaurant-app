<!-- app/views/password_reset/reset.php -->
<h2>Yeni Şifre Belirleyin</h2>

<form action="index.php?page=password_reset&action=reset" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
    
    <label for="password">Yeni Şifre:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Şifreyi Güncelle</button>
</form>
