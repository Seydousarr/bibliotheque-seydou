<?php
include "./header.php";
include "./fonction.php";
require "./DB.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $categorie = $_POST['categorie'];

    // Insertion dans la base de données
    $query = $pdo->prepare("INSERT INTO livres (titre, auteur, categorie) VALUES (?, ?, ?)");
    $query->execute([$titre, $auteur, $categorie]);

    header("Location: livres.php");
}
?>


<form action="ajout_livre.php" method="POST">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" required>

    <label for="auteur">Auteur</label>
    <input type="text" name="auteur" id="auteur" required>

    <label for="categorie">Catégorie</label>
    <input type="text" name="categorie" id="categorie" required>

    <button type="submit">Ajouter</button>
</form>
