<?php
if (!isset($baseUrl)) { $baseUrl = Flight::get('flight.base_url'); }
if (!isset($page_title)) { $page_title = 'Modifier une catégorie - TriHomme'; }
$isAdminUser = true;
$currentUser = ['nom_User' => 'Admin']; // Pour la navigation
ob_start();
?>
<div class="row justify-content-center">
  <div class="col-lg-6 col-md-8">
    <div class="card-modern">
      <div class="card-header-custom text-center">
        <h1 class="h3 mb-0">
          <i class="fas fa-edit me-2 text-warning"></i>
          Modifier la catégorie
        </h1>
        <p class="text-muted mb-0 mt-2">Modifiez les informations de la catégorie</p>
      </div>
      <div class="card-body p-4">
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger alert-modern">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>
        
        <form action="<?= $baseUrl ?>/updateCategorie" method="post" class="needs-validation" novalidate>
          <input type="hidden" name="id_categorie" value="<?= $categorie['id_Categorie'] ?? '' ?>">
          
          <div class="mb-4">
            <label for="nouveau_nom" class="form-label fw-semibold">
              <i class="fas fa-tag me-2 text-muted"></i>
              Nouveau nom de la catégorie
            </label>
            <input type="text" 
                   class="form-control form-control-modern" 
                   id="nouveau_nom" 
                   name="nouveau_nom" 
                   placeholder="Ex: Électronique, Vêtements, Maison..."
                   value="<?= htmlspecialchars($categorie['libelle'] ?? '') ?>"
                   required
                   minlength="2"
                   maxlength="50">
            <div class="invalid-feedback">
              Veuillez entrer un nom de catégorie valide (2-50 caractères).
            </div>
            <div class="form-text">
              <i class="fas fa-info-circle me-1"></i>
              Le nom doit être unique et descriptif
            </div>
          </div>
          
          <div class="d-flex gap-3 justify-content-end">
            <a href="<?= $baseUrl ?>/accueil/1" class="btn btn-outline-secondary">
              <i class="fas fa-times me-2"></i>
              Annuler
            </a>
            <button type="submit" class="btn btn-custom">
              <i class="fas fa-save me-2"></i>
              Modifier la catégorie
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <div class="mt-4">
      <div class="card-modern">
        <div class="card-body">
          <h6 class="text-muted mb-3">
            <i class="fas fa-info-circle me-2"></i>
            Informations importantes
          </h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2">
              <i class="fas fa-exclamation-triangle text-warning me-2"></i>
              La modification affectera tous les produits de cette catégorie
            </li>
            <li class="mb-2">
              <i class="fas fa-check text-success me-2"></i>
              Le nouveau nom doit être unique
            </li>
            <li class="mb-0">
              <i class="fas fa-history text-info me-2"></i>
              Cette action peut être annulée en modifiant à nouveau
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<script nonce="<?= Flight::get('csp_nonce') ?>">
// Validation Bootstrap
(function() {
  'use strict';
  window.addEventListener('load', function() {
    var forms = document.getElementsByClassName('needs-validation');
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';