<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - E-commerce</title>
</head>
<body>
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">Takalo-Takalo</a>
                <ul class="menu">
                    <li><a href="#">Accueil</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <h1>Bienvenue sur notre boutique</h1>
        <section class="product-list">

        <p>Liste des objets </p>
        <table>
            <tr>
            <td>id_Proprietaire</td>
            <td>id_Categorie</td>
            <td>libelle</td>
            <td>prix</td>
            </tr>
            <?php
            foreach($liste as $l){ ?>
            <tr>
                <td><?= $l['id_Proprietaire'] ?></td>
                <td><?= $l['id_Categorie'] ?></td>
                <td><?= $l['libelle'] ?></td>
                <td><?= $l['prix'] ?></td>
            </tr>
            <?php }
            ?>
        </table>
        <?php ?>
        </section>
    </main>
    <footer>
        <p>&copy; ETU 000000</p>
    </footer>
</body>
</html>