<?php 
session_start();
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil de <?= htmlspecialchars($user['nom_User']) ?></title>
</head>
<body>
    <h1>Profil de <?= htmlspecialchars($user['nom_User']) ?></h1>

    <?php if(empty($objets)){ ?>
        <div class="card-modern">
            <div class="card-body text-center p-5">
                <i class="fas fa-box-open fa-4x text-muted mb-4"></i>
                <h4 class="text-muted mb-3">Aucun produit proposé</h4>
                <p class="text-mutedmb-4">Cet utilisateur n'a pas encore proposé de produits à échanger.</p>
            </div>
        </div>
    <?php } else{ ?>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-modern mb-0">
                    <thead>
                    <tr>
                        <th><i class="fas fa-tag me-2"></i>Catégorie</th>
                        <th><i class="fas fa-box me-2"></i>Produit</th>
                        <th><i class="fas fa-euro-sign me-2"></i>Prix</th>
                        <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($objets as $obj): ?>
                        <tr>
                        <td>
                            <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                            <?= htmlspecialchars($obj['cat_lib']) ?>
                            </span>
                        </td>
                        <td class="fw-semibold"><?= htmlspecialchars($obj['obj_lib']) ?></td>
                        <td>
                            <span class="fw-bold text-success fs-6">
                            <?= number_format($obj['prix'], 0, ',', ' ') ?> €
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= $baseUrl ?>/echange/<?= $currentUser['id_User'] ?>/<?= $user['id_User'] ?>/<?= $obj['id_Objet'] ?>" 
                            class="btn btn-outline-primary">
                                Proposer un échange
                            </a>
                        </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
      </div>

    <?php } ?>

</body>
</html>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
