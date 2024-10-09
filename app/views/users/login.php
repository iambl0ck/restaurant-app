<h2 class="text-center">Giriş Yap</h2>

<?php if (isset($error)) { echo "<p style='color:red; text-align:center;'>$error</p>"; } ?>

<form action="index.php?page=login" method="POST" class="mx-auto" style="max-width: 400px;">
    <div class="mb-3">
        <label for="username" class="form-label">Kullanıcı Adı</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı adı" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Şifre</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
    </div>
    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me">
        <label class="form-check-label" for="remember_me">Beni Hatırla</label>
    </div>
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    <button type="submit" class="btn btn-primary w-100" style="margin-top: 20px;">Giriş Yap</button>
</form>
