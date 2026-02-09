<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link href="<?= $baseUrl ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= $baseUrl ?>/assets/bootstrap/js/validation-ajax.js" defer nonce="<?= Flight::get('csp_nonce') ?>"></script>

</head>

<body>
    <div class="container mt-5">
        <h1>Inscription</h1>
        <?php if ($success): ?>
            <div class="alert alert-success">Inscription réussie !</div>
        <?php endif; ?>
        <form id="registerForm" action="<?= $baseUrl ?>/register" method="post" data-validate="true" data-validate-url="<?= $baseUrl ?>/validate-register">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom"
                    value="<?= htmlspecialchars($values['nom']) ?>">
                <?php if ($errors['nom']): ?>
                    <div class="text-danger"><?= $errors['nom'] ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?= htmlspecialchars($values['email']) ?>">
                <?php if ($errors['email']): ?>
                    <div class="text-danger"><?= $errors['email'] ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if ($errors['password']): ?>
                    <div class="text-danger"><?= $errors['password'] ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmer mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <?php if ($errors['confirm_password']): ?>
                    <div class="text-danger"><?= $errors['confirm_password'] ?></div><?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">S'inscrire</button>
            <a href="<?= $baseUrl ?>/" class="btn btn-link">Se connecter</a>
        </form>
    </div>
    <script src="<?= $baseUrl ?>/assets/bootstrap/js/bootstrap.bundle.min.js" nonce="<?= Flight::get('csp_nonce') ?>"></script>
</body>

</html>