<!-- app/views/users/profile.php -->
<h2>Profilinizi Güncelleyin</h2>

<form action="index.php?page=user&action=profile" method="POST">
    <label for="name">Ad:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($_SESSION['user']['name']); ?>" required><br>

    <label for="surname">Soyad:</label>
    <input type="text" id="surname" name="surname" value="<?php echo htmlspecialchars($_SESSION['user']['surname']); ?>" required><br>

    <label for="email">E-posta:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user']['email']); ?>" required><br>

    <label for="password">Şifre (Boş bırakılırsa değiştirilmez):</label>
    <input type="password" id="password" name="password"><br>

    <button type="submit">Güncelle</button>
</form>
