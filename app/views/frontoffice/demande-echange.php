<?php
if (!isset($baseUrl)) { $baseUrl = Flight::get('flight.base_url'); }
if (!isset($page_title)) { $page_title = "Demande d'echange - Takalo-Takalo"; }
$isLoggedIn = !empty($currentUser);
ob_start();
?>
<div class="row mb-4">
  <div class="col-12">
    <div class="text-center mb-4">
      <h1 class="display-5 fw-bold">
        <i class="fas fa-store text-primary me-3"></i>
        Demande d'échange
      </h1>
      <p class="lead text-muted">Choisissez l'objet que vous voulez changer</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card-modern mb-5">
      <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fas fa-shopping-bag me-2"></i>
          Produit demandé
        </h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-modern mb-0">
            <thead>
              <tr>
                <th><i class="fas fa-tag me-2"></i>Produit</th>
                <th><i class="fas fa-box me-2"></i>Description</th>
                <th><i class="fas fa-euro-sign me-2"></i>Prix</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>
                    <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                       <?= $objet['obj_lib'] ?>
                    </span>
                  </td>
                  <?php 
                  if($objet['descriptions']!= null){ ?>
                  <td class="fw-semibold"><?= htmlspecialchars($objet['descriptions']) ?></td>
                  <td>
                  <?php }else{ ?>
                  <td class="fw-semibold">Pas encore de description</td>
                  <td>
                  <?php } ?>
                    <span class="fw-bold text-success fs-6">
                      <?= number_format($objet['prix'], 0, ',', ' ') ?> €
                    </span>
                  </td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
    <div class="text-center">
        <p>^</p>
        <p>|</p>
        <p>|</p> 
        <p>v</p>
    </div>
</div>
    
<!-- Choix de produits à échanger -->
<?php if (!empty($liste)): ?>
<div class="row">
  <div class="col-12">
    <div class="card-modern">
      <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fas fa-shopping-bag me-2"></i>
          Mes produits :
        </h5>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-modern mb-0">
            <thead>
              <tr>
                <th><i class="fas fa-tag me-2"></i>Produit</th>
                <th><i class="fas fa-box me-2"></i>Description</th>
                <th><i class="fas fa-euro-sign me-2"></i>Prix</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($liste as $objet): ?>
                <tr>
                  <td>
                    <span class="badge bg-light text-dark fw-semibold px-3 py-2">
                       <?= $objet['obj_lib'] ?>
                    </span>
                  </td>
                  <?php 
                  if($objet['descriptions']!= null){ ?>
                  <td class="fw-semibold"><?= htmlspecialchars($objet['descriptions']) ?></td>
                  <td>
                  <?php }else{ ?>
                  <td class="fw-semibold">Pas encore de description</td>
                  <td>
                  <?php } ?>
                    <span class="fw-bold text-success fs-6">
                      <?= number_format($objet['prix'], 0, ',', ' ') ?> €
                    </span>
                  </td>
                  <td>
                    <a href="" class="btn btn-outline-success">
                        Proposer l'échange
                    </a>
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
