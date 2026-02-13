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
        Gestion de vos objets
      </h1>
      <p class="lead text-muted">Modifier vos objets actuels ou ajouter des nouveaux </p>
    </div>
  </div>
</div>

<?php if (!empty($objets)): ?>
<div class="row">
  <div class="col-12">
    <div class="card-modern">
      <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fas fa-shopping-bag me-2"></i>
          Mes produits :
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
                <th><i class="fas fa-tag me-2"></i>Catégorie</th>
                <th><i class="fas fa-box me-2"></i>Produit</th>
                <th><i class="fas fa-euro-sign me-2"></i>Prix</th>
                <th class="text-center"><i class="fas fa-cogs me-2"></i>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($objets as $o): ?>
                <tr>
                  <td>
                    <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                       <?= $o['libelle'] ?>
                    </span>
                  </td>
                  <?php 
                  if($o['descriptions']!= null){ ?>
                  <td class="fw-semibold"><?= htmlspecialchars($o['descriptions']) ?></td>
                  <td>
                  <?php }else{ ?>
                  <td class="fw-semibold">Pas encore de description</td>
                  <td>
                  <?php } ?>
                    <span class="fw-bold text-success fs-6">
                      <?= number_format($o['prix'], 0, ',', ' ') ?> €
                    </span>
                  </td>
                  <td class="text-center">
                    <div class="btn-group btn-group-sm">
                      <button class="btn btn-outline-primary" title="Voir détails">
                        <a href="<?= $baseUrl ?>/">Fiche-produit</a>
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
        <h4 class="text-muted mb-3">Vous n'avez pas encore ajouter de produits.</h4>
        <p class="text-muted mb-4">Ajouter en pour pouvoir les modifiers.</p>
        <button class="btn btn-custom">
          <i class="fas fa-bell me-2"></i>
          Ajouter un objet
        </button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
