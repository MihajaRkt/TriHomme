<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - E-commerce</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="index.php" class="logo">E-Varotra</a>
                <ul class="menu">
                    <li><a href="index.php">Accueil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h1>Bienvenue sur notre boutique</h1>
        <?php foreach($produits as $p){ ?>

            <section class="product-list">
                <article class="product-card">
                    <a href="produit.php">
                        <img src="images/<?= $p['img'] ?>" alt="Produit 1">
                        <h2> <?= $p['name'] ?> </h2>
                        <p>Prix : <?= $p['prix'] ?> </p>
                    </a>
                </article>
            </section>

        <?php } ?>
    </main>
    <footer>
        <p>&copy; 2025 E-Varotra</p>
    </footer>
</body>
</html>