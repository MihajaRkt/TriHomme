<?php
if (!isset($baseUrl)) { $baseUrl = Flight::get('flight.base_url'); }
if (!isset($page_title)) { $page_title = 'Accueil - Takalo-Takalo'; }
$isLoggedIn = !empty($currentUser);
ob_start();
?>
<div class="row mb-4">
  <div class="col-12">
    <div class="text-center mb-4">
      <h1 class="display-5 fw-bold">
        <i class="fas fa-store text-primary me-3"></i>
        Bienvenue sur Takalo-Takalo
      </h1>
      <p class="lead text-muted">Découvrez notre sélection de produits exceptionnels</p>
    </div>
  </div>
</div>

<div class="row mb-4">
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="stat-card">
      <div class="stat-number"><?= count($liste) ?></div>
      <div><i class="fas fa-box me-2"></i>Produits disponibles</div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="stat-card" style="background: linear-gradient(135deg, #10b981, #059669);">
      <div class="stat-number"><?= count($users) ?></div>
      <div><i class="fas fa-users me-2"></i>Membres actifs</div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="stat-card" style="background: linear-gradient(135deg, #f59e0b, #d97706);">
      <div class="stat-number"><?= date('H') ?></div>
      <div><i class="fas fa-clock me-2"></i>Heure actuelle</div>
    </div>
  </div>
  <div class="col-lg-3 col-md-6 mb-3">
    <div class="stat-card" style="background: linear-gradient(135deg, #ef4444, #dc2626);">
      <div class="stat-number">♥</div>
      <div><i class="fas fa-heart me-2"></i>Favoris</div>
    </div>
  </div>
</div>

<?php if (!empty($liste)): ?>
<div class="row">
  <div class="col-12">
    <div class="card-modern">
      <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fas fa-shopping-bag me-2"></i>
          Catalogue des produits
        </h5>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-primary btn-sm" id="gridView">
            <i class="fas fa-th"></i>
          </button>
          <button class="btn btn-primary btn-sm" id="listView">
            <i class="fas fa-list"></i>
          </button>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-modern mb-0">
            <thead>
              <tr>
                <th><i class="fas fa-user me-2"></i>Propriétaire</th>
                <th><i class="fas fa-tag me-2"></i>Catégorie</th>
                <th><i class="fas fa-box me-2"></i>Produit</th>
                <th><i class="fas fa-euro-sign me-2"></i>Prix</th>
                <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($liste as $produit): ?>
                <tr>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-3">
                        <i class="fas fa-user text-primary"></i>
                      </div>
                      <span class="fw-semibold"> <?= htmlspecialchars($produit['nom_User']) ?></span>
                    </div>
                  </td>
                  <td>
                    <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                       <?= htmlspecialchars($produit['cat_lib']) ?>
                    </span>
                  </td>
                  <td class="fw-semibold"><?= htmlspecialchars($produit['obj_lib']) ?></td>
                  <td>
                    <span class="fw-bold text-success fs-6">
                      <?= number_format($produit['prix'], 0, ',', ' ') ?> €
                    </span>
                  </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" title="Voir détails">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button class="btn btn-outline-success" title="Ajouter au panier">
                        <i class="fas fa-cart-plus"></i>
                      </button>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php else: ?>
<div class="row">
  <div class="col-12">
    <div class="card-modern">
      <div class="card-body text-center p-5">
        <i class="fas fa-shopping-cart fa-4x text-muted mb-4"></i>
        <h4 class="text-muted mb-3">Aucun produit disponible</h4>
        <p class="text-muted mb-4">Notre catalogue sera bientôt rempli de produits exceptionnels.</p>
        <button class="btn btn-custom">
          <i class="fas fa-bell me-2"></i>
          Me notifier des nouveautés
        </button>
      </div>
    </div>
  </div>
</div>
<?php endif; 
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
