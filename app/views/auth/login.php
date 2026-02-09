<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Connexion</h1>
    <?php if (isset($errors['_global'])): ?>
        <div class="alert alert-danger"><?= $errors['_global'] ?></div>
    <?php endif; ?>
    <form id="loginForm" action="/login" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($values['email']) ?>">
            <?php if ($errors['email']): ?><div class="text-danger"><?= $errors['email'] ?></div><?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password">
            <?php if ($errors['password']): ?><div class="text-danger"><?= $errors['password'] ?></div><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
        <a href="/register" class="btn btn-link">S'inscrire</a>
    </form>
</div>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/validate-login', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        // Mettre à jour les erreurs
        document.querySelectorAll('.text-danger').forEach(el => el.textContent = '');
        if (!data.ok) {
            for (const [field, error] of Object.entries(data.errors)) {
                const errorEl = document.querySelector(`[name=${field}]`).nextElementSibling;
                if (errorEl && errorEl.classList.contains('text-danger')) {
                    errorEl.textContent = error;
                }
            }
        } else {
            this.submit();
        }
    });
});
</script>
</body>
</html>