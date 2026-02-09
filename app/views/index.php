<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link href="<?= $baseUrl ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?= $baseUrl ?>/assets/bootstrap/js/validation-ajax.js" defer nonce="<?= Flight::get('csp_nonce') ?>"></script>
</head>

<body>
    <div class="container mt-5">
        <h1>Connexion</h1>
        <?php if ($errors['_global']): ?>
            <div class="alert alert-danger"><?= $errors['_global'] ?></div>
        <?php endif; ?>
        <form id="loginForm" action="<?= $baseUrl ?>/login" method="post" data-validate="true" data-validate-url="<?= $baseUrl ?>/validate-login">
            <div class="mb-3">
                <label for="mail" class="form-label">Email</label>
                <input type="email" class="form-control" id="mail" name="mail" value="<?= htmlspecialchars($values['mail'] ?: ($admin['mail_User'] ?? '')) ?>">
                <?php if ($errors['mail']): ?>
                    <div class="text-danger"><?= $errors['mail'] ?></div><?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if ($errors['password']): ?>
                    <div class="text-danger"><?= $errors['password'] ?></div><?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
        <a href="<?= $baseUrl ?>/register" class="btn btn-link">S'inscrire</a>

    </div>
    <script src="<?= $baseUrl ?>/assets/bootstrap/js/bootstrap.bundle.min.js" nonce="<?= Flight::get('csp_nonce') ?>"></script>
</body>

</html>