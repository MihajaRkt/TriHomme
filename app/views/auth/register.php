<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Inscription</h1>
    <?php if ($success): ?>
        <div class="alert alert-success">Inscription réussie !</div>
    <?php endif; ?>
    <form id="registerForm" action="/register" method="post">
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($values['nom']) ?>">
            <?php if ($errors['nom']): ?><div class="text-danger"><?= $errors['nom'] ?></div><?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($values['prenom']) ?>">
            <?php if ($errors['prenom']): ?><div class="text-danger"><?= $errors['prenom'] ?></div><?php endif; ?>
        </div>
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
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirmer mot de passe</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
            <?php if ($errors['confirm_password']): ?><div class="text-danger"><?= $errors['confirm_password'] ?></div><?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="telephone" name="telephone" value="<?= htmlspecialchars($values['telephone']) ?>">
            <?php if ($errors['telephone']): ?><div class="text-danger"><?= $errors['telephone'] ?></div><?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">S'inscrire</button>
        <a href="/login" class="btn btn-link">Se connecter</a>
    </form>
</div>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/validate-register', {
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