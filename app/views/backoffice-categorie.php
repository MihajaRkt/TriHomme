<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackOffice Categorie</title>
</head>

<body>
    <h1>BackOffice</h1>

    <a href="<?= $baseUrl ?>/redirectCategorie">Ajouter une nouvelle categorie</a>
    <h5>Liste des categories</h5>
    <table border="1">
        <?php foreach ($liste_categorie as $l) { ?>
        <tr>
            <td><?= $l['libelle'] ?></td>
        </tr>
        <?php } ?>
    </table>


</body>

</html>