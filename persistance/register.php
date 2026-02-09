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
            <label for="mail" class="form-label">Email</label>
            <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($values['mail']) ?>">
            <?php if ($errors['mail']): ?><div class="text-danger"><?= $errors['mail'] ?></div><?php endif; ?>
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
        <button type="submit" class="btn btn-primary">S'inscrire</button>
        <a href="/login" class="btn btn-link">Se connecter</a>
    </form>
</div>
<script src="/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
const regForm = document.getElementById('registerForm');
if (regForm) {
    regForm.addEventListener('submit', function(e) {
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
                    const fieldEl = document.querySelector(`[name="${field}"]`);
                    if (!fieldEl) continue;
                    let errorEl = fieldEl.nextElementSibling;
                    while (errorEl && !(errorEl.classList && errorEl.classList.contains('text-danger'))) {
                        errorEl = errorEl.nextElementSibling;
                    }
                    if (errorEl) errorEl.textContent = error;
                }
            } else {
                this.submit();
            }
        }).catch(err => console.error(err));
    });
}
</script>
</body>
</html>