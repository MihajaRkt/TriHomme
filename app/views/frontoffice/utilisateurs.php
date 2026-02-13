<?php
$page_title = 'Liste des Utilisateurs - TriHomme';
ob_start();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header card-header-custom">
                    <h2 class="mb-0">
                        <i class="fas fa-users me-2"></i>
                        Liste des Utilisateurs
                    </h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php if (empty($users)): ?>
                            <div class="col-12">
                                <div class="alert alert-info alert-modern">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Aucun utilisateur trouvé.
                                </div>
                            </div>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card card-modern h-100">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                                            </div>
                                            <h5 class="card-title"><?= htmlspecialchars($user['nom_User']) ?></h5>
                                            <p class="card-text text-muted"><?= htmlspecialchars($user['mail_User']) ?></p>
                                            <?php if ($user['isAdmin']): ?>
                                                <span class="badge bg-warning text-dark">Administrateur</span>
                                            <?php endif; ?>
                                            <div class="mt-3">
                                                <a href="<?= $baseUrl ?>/profil/<?= $currentUser['id_User'] ?>/<?= $user['id_User'] ?>"
                                                    class="btn btn-custom btn-sm">
                                                    <i class="fas fa-eye"></i> Voir Profil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>