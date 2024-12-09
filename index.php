<?php
// Inclusion de l'en-tête
include "./header.php";
include "./fonction.php";
require "./DB.php";

?>

<!-- Contenu principal -->
<main class="container my-5">
    <div class="centrer">
        <h1 class="text-center">Bienvenue dans la Bibliothèque du Future</h1>
        <p class="text-center">
            Explorez notre collection de livres disponibles, ajoutez de nouveaux livres, et gérez votre compte utilisateur.
        </p>
        <div class="text-center">
            <a href="livres.php" class="btn btn-primary btn-lg">Voir les livres</a>
            <a href="ajout_livre.php" class="btn btn-secondary btn-lg">Ajouter un livre</a>
        </div>
    </div>
</main>

<?php
// Inclusion du pied de page
include "footer.php";
?>
