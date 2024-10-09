<h2 class="text-center">Kayıt Ol</h2>
<?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
<form action="index.php?page=register" method="POST" class="mx-auto" style="max-width: 400px;">
    <div class="mb-3">
        <label for="name" class="form-label">İsim</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="İsim" required>
    </div>
    <div class="mb-3">
        <label for="surname" class="form-label">Soyisim</label>
        <input type="text" class="form-control" id="surname" name="surname" placeholder="Soyisim" required>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Kullanıcı Adı</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı adı" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Şifre</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
    </div>
    <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
    <button type="submit" class="btn btn-primary w-100">Kayıt Ol</button>
</form>
