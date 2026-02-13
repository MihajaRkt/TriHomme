<?php
if (!isset($baseUrl)) { $baseUrl = Flight::get('flight.base_url'); }
if (!isset($page_title)) { $page_title = 'Nouvelle catégorie - TriHomme'; }
$isAdminUser = true;
$currentUser = ['nom_User' => 'Admin']; // Pour la navigation
ob_start();
?>
<div class="row justify-content-center">
  <div class="col-lg-6 col-md-8">
    <div class="card-modern">
      <div class="card-header-custom text-center">
        <h1 class="h3 mb-0">
          <i class="fas fa-plus-circle me-2 text-success"></i>
          Nouvelle catégorie
        </h1>
        <p class="text-muted mb-0 mt-2">Ajoutez une nouvelle catégorie de produits</p>
      </div>
      <div class="card-body p-4">
        <form action="<?= $baseUrl ?>/insertCategorie" method="post" class="needs-validation" novalidate>
          <div class="mb-4">
            <label for="nom_categorie" class="form-label fw-semibold">
              <i class="fas fa-tag me-2 text-muted"></i>
              Nom de la catégorie
            </label>
            <input type="text" 
                   class="form-control form-control-modern" 
                   id="nom_categorie" 
                   name="nom_categorie" 
                   placeholder="Ex: Électronique, Vêtements, Maison..."
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
              Créer la catégorie
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <div class="mt-4">
      <div class="card-modern">
        <div class="card-body">
          <h6 class="text-muted mb-3">
            <i class="fas fa-lightbulb me-2"></i>
            Conseils pour nommer vos catégories
          </h6>
          <ul class="list-unstyled mb-0">
            <li class="mb-2">
              <i class="fas fa-check text-success me-2"></i>
              Utilisez des noms clairs et descriptifs
            </li>
            <li class="mb-2">
              <i class="fas fa-check text-success me-2"></i>
              Évitez les caractères spéciaux
            </li>
            <li class="mb-0">
              <i class="fas fa-check text-success me-2"></i>
              Pensez à la recherche utilisateur
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
