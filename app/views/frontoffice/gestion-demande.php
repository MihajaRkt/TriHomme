<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php var_dump($listeDemande); ?>
    <table border="1">
        <tr>
            <td>Nom de l'utilisateur</td>
            <td>Objet proposé</td>
            <td>Objet demandé</td>
        </tr>
        <?php foreach ($listeDemande as $l) { ?>
            <tr>
                <td><?= $l['nom_User'] ?></td>
                <td><?= $l['libEnvoyeur'] ?></td>
                <td><?= $l['libReceveur'] ?></td>
                <a href="<?= $baseUrl ?>/accepter-echange/<?= $l['idEchange'] ?>">Accepter</a>
                <a href="<?= $baseUrl ?>/refuser-echange/<?= $l['idEchange'] ?>">Décliner</a>
            </tr>
        <?php } ?>

    </table>

</html>