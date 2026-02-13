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
      <p class="lead text-muted">Ajout de produit </p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card-modern">
      <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h5 class="mb-0">
          <i class="fas fa-shopping-bag me-2"></i>
          Ajouter un produit :
        </h5>
      </div>
      <div class="card-body p-0">
        <p>Objet detenu par : <strong><?= $main['nom_User'] ?></strong></p>
        <p>Categorie : <strong><?= $main['categorie'] ?></strong></p>
        <p>Prix : <strong><?= $main['prix'] ?>$</strong></p>
        <p>Description : 
            <?php if($main['descriptions']!=null){ ?>
             <strong><?= $main['descriptions'] ?></strong> 
             <?php }else{ ?>
             <strong>Aucune description</strong>
              <?php } ?>
            </p>
      </div>
    </div>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
