<?php
// layout.php - modern Bootstrap template
if (!isset($page_title)) {
  $page_title = 'TriHomme';
}
if (!isset($baseUrl)) {
  $baseUrl = Flight::get('flight.base_url') ?: '';
}
$isLoggedIn = !empty($currentUser ?? false);
$isAdmin = !empty($isAdminUser ?? false);
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($page_title) ?></title>
  <link href="<?= $baseUrl ?>/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #6366f1;
      --secondary-color: #f8fafc;
      --accent-color: #0ea5e9;
      --text-dark: #1e293b;
      --border-light: #e2e8f0;
      --success-color: #10b981;
      --danger-color: #ef4444;
    }

    body {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      backdrop-filter: blur(20px);
      margin-top: 2rem;
      margin-bottom: 2rem;
      overflow: hidden;
    }

    .navbar-custom {
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      border-radius: 20px 20px 0 0;
      padding: 1.5rem 2rem;
    }

    .brand {
      font-weight: 700;
      font-size: 1.5rem;
      color: white !important;
      text-decoration: none;
    }

    .brand i {
      color: #fbbf24;
      margin-right: 0.5rem;
    }

    .nav-link-custom {
      color: rgba(255, 255, 255, 0.9) !important;
      font-weight: 500;
      padding: 0.5rem 1rem !important;
      border-radius: 10px;
      transition: all 0.3s ease;
    }

    .nav-link-custom:hover {
      background: rgba(255, 255, 255, 0.2);
      color: white !important;
      transform: translateY(-2px);
    }

    .btn-custom {
      background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
      border: none;
      border-radius: 12px;
      padding: 0.75rem 2rem;
      font-weight: 600;
      color: white;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }

    .btn-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
      color: white;
    }

    .card-modern {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      overflow: hidden;
    }

    .card-modern:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }

    .card-header-custom {
      background: linear-gradient(135deg, #f8fafc, #e2e8f0);
      border: none;
      padding: 1.5rem 2rem;
      font-weight: 600;
      color: var(--text-dark);
    }

    .form-control-modern {
      border: 2px solid var(--border-light);
      border-radius: 12px;
      padding: 0.75rem 1rem;
      transition: all 0.3s ease;
      font-size: 1rem;
    }

    .form-control-modern:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
      outline: none;
    }

    .alert-modern {
      border: none;
      border-radius: 12px;
      padding: 1rem 1.5rem;
      font-weight: 500;
    }

    .table-modern {
      border-radius: 12px;
      overflow: hidden;
    }

    .table-modern thead th {
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      font-weight: 600;
      border: none;
      padding: 1rem;
    }

    .table-modern tbody td {
      padding: 1rem;
      border: none;
      border-bottom: 1px solid var(--border-light);
      vertical-align: middle;
    }

    .footer-custom {
      background: var(--secondary-color);
      padding: 2rem;
      text-align: center;
      color: #64748b;
      font-weight: 500;
    }

    .animation-fade-in {
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .stat-card {
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border-radius: 16px;
      padding: 2rem;
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .stat-number {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 0.5rem;
    }

    .sidebar {
      background: linear-gradient(180deg, var(--primary-color), var(--accent-color));
      min-height: 100vh;
      border-radius: 0 20px 20px 0;
    }

    .sidebar .nav-link {
      color: rgba(255, 255, 255, 0.9);
      padding: 1rem 1.5rem;
      border-radius: 0 25px 25px 0;
      margin: 0.25rem 0;
      transition: all 0.3s ease;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
      background: rgba(255, 255, 255, 0.2);
      color: white;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="main-container">
      <?php if ($isLoggedIn): ?>
        <nav class="navbar-custom d-flex justify-content-between align-items-center">
          <a class="brand" href="<?= $baseUrl ?>">
            <i class="fas fa-store"></i>Takalo-Takalo
          </a>
          <div class="d-flex align-items-center gap-3">
            <?php if ($isAdmin): ?>
              <a href="<?= $baseUrl ?>/redirectCategorie" class="nav-link-custom">
                <i class="fas fa-plus-circle"></i> Nouvelle catégorie
              </a>
            <?php endif; ?>
            <div class="dropdown">
              <button class="btn nav-link-custom dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle"></i>
                <?= htmlspecialchars($currentUser['nom_User'] ?? 'Utilisateur') ?>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= $baseUrl ?>/logout">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                  </a></li>
                <?php if (!$isAdmin): ?>
                  <li><a class="dropdown-item" href="<?= $baseUrl ?>/gestionobjet/<?= $currentUser['id_User'] ?>">
                      <i class="fas fa-sign-out-alt"></i> Mes objets
                    </a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </nav>
      <?php else: ?>
        <nav class="navbar-custom d-flex justify-content-between align-items-center">
          <a class="brand" href="<?= $baseUrl ?>">
            <i class="fas fa-store"></i>Takalo-Takalo
          </a>
          <div class="d-flex gap-3">
            <a href="<?= $baseUrl ?>" class="nav-link-custom">
              <i class="fas fa-sign-in-alt"></i> Connexion
            </a>
            <a href="<?= $baseUrl ?>/register" class="nav-link-custom">
              <i class="fas fa-user-plus"></i> Inscription
            </a>
          </div>
        </nav>
      <?php endif; ?>

      <main class="p-4 animation-fade-in">
        <?= $content ?? '' ?>
      </main>

      <footer class="footer-custom">
        <div class="d-flex justify-content-center align-items-center">
          <i class="fas fa-copyright me-2"></i>
          <span><?= date('Y') ?> TriHomme - Plateforme moderne de commerce</span>
        </div>
      </footer>
    </div>

  </div>

  <script src="<?= $baseUrl ?>/assets/bootstrap/js/bootstrap.bundle.min.js"
    nonce="<?= Flight::get('csp_nonce') ?>"></script>
</body>

</html>