<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - TriHomme</title>
    <link href="<?= $baseUrl ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= $baseUrl ?>/assets/bootstrap/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= $baseUrl ?>/accueil"><i class="bi bi-shop"></i> TriHomme</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="<?= $baseUrl ?>/accueil"><i class="bi bi-house"></i> Accueil</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-people"></i> Utilisateurs
                        </a>
                        <ul class="dropdown-menu">
                            <?php if (!empty($users)): ?>
                                <?php foreach ($users as $u): ?>
                                    <li>
                                        <span class="dropdown-item">
                                            <?= htmlspecialchars($u['nom_User']) ?>
                                            <small class="text-muted">(<?= htmlspecialchars($u['mail_User']) ?>)</small>
                                            <?php if ($u['isAdmin']): ?>
                                                <span class="badge bg-warning text-dark">Admin</span>
                                            <?php endif; ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li><span class="dropdown-item text-muted">Aucun utilisateur</span></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $baseUrl ?>/admin"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if ($currentUser): ?>
                        <li class="nav-item">
                            <span class="nav-link text-light">
                                <i class="bi bi-person-circle"></i> <?= htmlspecialchars($currentUser['nom_User']) ?>
                            </span>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="<?= $baseUrl ?>/logout"><i class="bi bi-box-arrow-right"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        <h2 class="mb-4">Bienvenue sur notre boutique</h2>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-list-ul"></i> Liste des objets
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Propriétaire</th>
                            <th>Catégorie</th>
                            <th>Libellé</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($liste)): ?>
                            <?php foreach ($liste as $l): ?>
                                <tr>
                                    <td><?= htmlspecialchars($l['id_Proprietaire']) ?></td>
                                    <td><?= htmlspecialchars($l['id_Categorie']) ?></td>
                                    <td><?= htmlspecialchars($l['libelle']) ?></td>
                                    <td><?= htmlspecialchars($l['prix']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-muted">Aucun objet trouvé</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p class="mb-0">&copy; 2026 TriHomme</p>
    </footer>

    <script src="<?= $baseUrl ?>/assets/bootstrap/js/bootstrap.bundle.min.js" nonce="<?= Flight::get('csp_nonce') ?>"></script>
</body>
</html>