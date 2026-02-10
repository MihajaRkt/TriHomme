<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>None</title>
</head>
<body>
    <h1>Insertion categorie</h1>
    
    <form action="<?= $baseUrl ?>/insertCategorie" method="post">
        <p>Nom de la categorie<input type="text" name="nom_categorie" required></p>
        <input type="submit" value="Inserer">
    </form>
</body>
</html>