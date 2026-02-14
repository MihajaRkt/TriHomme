<?php
if (!isset($baseUrl)) { $baseUrl = Flight::get('flight.base_url'); }
if (!isset($page_title)) { $page_title = 'Connexion - TriHomme'; }
ob_start();
?>
<div class="row justify-content-center">
  <div class="col-lg-5 col-md-7">
    <div class="card-modern">
      <div class="card-header-custom text-center">
        <h1 class="h3 mb-0">
          <i class="fas fa-sign-in-alt me-2 text-primary"></i>
          Bienvenue sur TriHomme
        </h1>
        <p class="text-muted mb-0 mt-2">Connectez-vous pour accéder à votre espace</p>
      </div>
      <div class="card-body p-4">
        <?php if (!empty($errors['_global'])): ?>
          <div class="alert alert-danger alert-modern">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $errors['_global'] ?>
          </div>
        <?php endif; ?>
        
        <form id="loginForm" action="<?= $baseUrl ?>/login" method="post" data-validate="true" data-validate-url="<?= $baseUrl ?>/validate-login">
          <div class="mb-4">
            <label for="mail" class="form-label fw-semibold">
              <i class="fas fa-envelope me-2 text-muted"></i>Adresse email
            </label>
            <input type="email" class="form-control form-control-modern" id="mail" name="mail" 
                   placeholder="votre@email.com"
                   value="<?= htmlspecialchars($values['mail'] ?: ($admin['mail_User'] ?? '')) ?>">
            <?php if (!empty($errors['mail'])): ?>
              <div class="text-danger mt-2"><small><?= $errors['mail'] ?></small></div>
            <?php endif; ?>
          </div>
          
          <div class="mb-4">
            <label for="password" class="form-label fw-semibold">
              <i class="fas fa-lock me-2 text-muted"></i>Mot de passe
            </label>
            <input type="password" class="form-control form-control-modern" id="password" name="password" 
                   placeholder="Votre mot de passe" value="aaaaaaaa">
            <?php if (!empty($errors['password'])): ?>
              <div class="text-danger mt-2"><small><?= $errors['password'] ?></small></div>
            <?php endif; ?>
          </div>
          
          <div class="d-grid gap-3">
            <button type="submit" class="btn btn-custom btn-lg">
              <i class="fas fa-sign-in-alt me-2"></i>
              Se connecter
            </button>
            
            <div class="text-center">
              <span class="text-muted">Pas encore de compte ?</span>
              <a href="<?= $baseUrl ?>/register" class="text-primary text-decoration-none fw-semibold ms-1">
                Créer un compte
              </a>
            </div>
          </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
