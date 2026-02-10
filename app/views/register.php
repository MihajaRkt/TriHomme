<?php
if (!isset($baseUrl)) { $baseUrl = Flight::get('flight.base_url'); }
if (!isset($page_title)) { $page_title = 'Inscription - TriHomme'; }
ob_start();
?>
<div class="row justify-content-center">
  <div class="col-lg-6 col-md-8">
    <div class="card-modern">
      <div class="card-header-custom text-center">
        <h1 class="h3 mb-0">
          <i class="fas fa-user-plus me-2 text-success"></i>
          Créer votre compte
        </h1>
        <p class="text-muted mb-0 mt-2">Rejoignez la communauté TriHomme</p>
      </div>
      <div class="card-body p-4">
        <?php if (!empty($success)): ?>
          <div class="alert alert-success alert-modern">
            <i class="fas fa-check-circle me-2"></i>
            Inscription réussie ! Bienvenue sur TriHomme.
          </div>
        <?php endif; ?>
        
        <form id="registerForm" action="<?= $baseUrl ?>/register" method="post" data-validate="true" data-validate-url="<?= $baseUrl ?>/validate-register">
          <div class="row">
            <div class="col-12 mb-4">
              <label for="nom" class="form-label fw-semibold">
                <i class="fas fa-user me-2 text-muted"></i>Nom complet
              </label>
              <input type="text" class="form-control form-control-modern" id="nom" name="nom" 
                     placeholder="John Doe" value="<?= htmlspecialchars($values['nom']) ?>">
              <?php if (!empty($errors['nom'])): ?>
                <div class="text-danger mt-2"><small><?= $errors['nom'] ?></small></div>
              <?php endif; ?>
            </div>
            
            <div class="col-12 mb-4">
              <label for="email" class="form-label fw-semibold">
                <i class="fas fa-envelope me-2 text-muted"></i>Adresse email
              </label>
              <input type="email" class="form-control form-control-modern" id="email" name="email" 
                     placeholder="john@example.com" value="<?= htmlspecialchars($values['email']) ?>">
              <?php if (!empty($errors['email'])): ?>
                <div class="text-danger mt-2"><small><?= $errors['email'] ?></small></div>
              <?php endif; ?>
            </div>
            
            <div class="col-md-6 mb-4">
              <label for="password" class="form-label fw-semibold">
                <i class="fas fa-lock me-2 text-muted"></i>Mot de passe
              </label>
              <input type="password" class="form-control form-control-modern" id="password" name="password" 
                     placeholder="••••••••">
              <?php if (!empty($errors['password'])): ?>
                <div class="text-danger mt-2"><small><?= $errors['password'] ?></small></div>
              <?php endif; ?>
            </div>
            
            <div class="col-md-6 mb-4">
              <label for="confirm_password" class="form-label fw-semibold">
                <i class="fas fa-lock me-2 text-muted"></i>Confirmer
              </label>
              <input type="password" class="form-control form-control-modern" id="confirm_password" name="confirm_password" 
                     placeholder="••••••••">
              <?php if (!empty($errors['confirm_password'])): ?>
                <div class="text-danger mt-2"><small><?= $errors['confirm_password'] ?></small></div>
              <?php endif; ?>
            </div>
          </div>
          
          <div class="d-grid gap-3">
            <button type="submit" class="btn btn-custom btn-lg">
              <i class="fas fa-user-plus me-2"></i>
              Créer mon compte
            </button>
            
            <div class="text-center">
              <span class="text-muted">Déjà inscrit ?</span>
              <a href="<?= $baseUrl ?>/" class="text-primary text-decoration-none fw-semibold ms-1">
                Se connecter
              </a>
            </div>
          </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
