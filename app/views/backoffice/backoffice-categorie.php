<?php
if (!isset($baseUrl)) {
    $baseUrl = Flight::get('flight.base_url');
}
if (!isset($page_title)) {
    $page_title = 'Administration - Catégories';
}
$isAdminUser = true;
$currentUser = ['nom_User' => 'Admin']; // Pour la navigation
ob_start();
?>
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h2 mb-1">
                    <i class="fas fa-cogs me-2 text-primary"></i>
                    Administration
                </h1>
                <p class="text-muted mb-0">Gestion des catégories de produits</p>
            </div>
            <a href="<?= $baseUrl ?>/redirectCategorie" class="btn btn-custom">
                <i class="fas fa-plus-circle me-2"></i>
                Nouvelle catégorie
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card">
            <div class="stat-number"><?= count($liste_categorie) ?></div>
            <div><i class="fas fa-tags me-2"></i>Catégories totales</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #10b981, #059669);">
            <div class="stat-number">
                <?php
                $total = 0;
                foreach ($liste_categorie as $cat) {
                    $total += (int) ($cat['nombre'] ?? 0);
                }
                echo $total;
                ?>
            </div>
            <div><i class="fas fa-box me-2"></i>Produits totaux</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #8b5cf6, #7c3aed);">
            <div class="stat-number"><?= $nombre_utilisateurs ?? 0 ?></div>
            <div><i class="fas fa-users me-2"></i>Utilisateurs inscrits</div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
            <div class="stat-number"><?= date('d/m') ?></div>
            <div><i class="fas fa-calendar me-2"></i>Aujourd'hui</div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card-modern">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list-ul me-2"></i>
                    Liste des catégories
                </h5>
                <span class="badge bg-primary rounded-pill"><?= count($liste_categorie) ?> catégories</span>
            </div>
            <div class="card-body p-0">
                <?php if (!empty($liste_categorie)): ?>
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-tag me-2"></i>Nom de la catégorie</th>
                                    <th class="text-center"><i class="fas fa-box me-2"></i>Nombre d'articles</th>
                                    <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($liste_categorie as $categorie): ?>
                                    <tr>
                                        <td class="fw-semibold">
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                                                    <i class="fas fa-tag text-primary"></i>
                                                </div>
                                                <?= $categorie['nom'] ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                                                <?= (int) ($categorie['nombre'] ?? 0) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group btn-group-sm">
                                                <a href="<?= $baseUrl ?>/editCategorie/<?= $categorie['id_categorie'] ?>" class="btn btn-outline-primary" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="<?= $baseUrl ?>/supprimerCategorie/<?= $categorie['id_categorie'] ?>" class="btn btn-outline-danger" title="Supprimer">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center p-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Aucune catégorie trouvée</h5>
                        <p class="text-muted mb-4">Commencez par créer votre première catégorie.</p>
                        <a href="<?= $baseUrl ?>/redirectCategorie" class="btn btn-custom">
                            <i class="fas fa-plus-circle me-2"></i>
                            Créer une catégorie
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
?>

