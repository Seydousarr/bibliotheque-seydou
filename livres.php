<?php
include "./header.php";
include "./fonction.php";
require "./DB.php";

// Récupérer les livres depuis la base de données
$query = $pdo->prepare("SELECT * FROM livres");
$query->execute();
$livres = $query->fetchAll();

?>

<table class="table table-hover">
    <h3>Liste des livres</h3>
    <thead>
        <tr>
            <th scope="row">Identifiant</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($livres as $livre): ?>
            <tr>
                <!-- Correction ici : utilisez la syntaxe correcte pour accéder aux valeurs -->
                <td><?= $livre['id_livre'] ?></td>
                <td><?= $livre['titre'] ?></td>
                <td><?= $livre['auteur'] ?></td>
                <td><?= $livre['categorie'] ?></td>
                <td>
                    <a href="modification_livre.php?id=<?= $livre['id_livre'] ?>">Modifier</a>
                    <a href="suppression_livre.php?id=<?= $livre['id_livre'] ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "./footer.php"; ?>

