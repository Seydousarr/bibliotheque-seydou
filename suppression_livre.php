<?php

include "header.php";
require "db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Préparation et exécution de la requête de suppression
        $statement = $pdo->prepare("DELETE FROM livres WHERE id_livre = ?");
        $statement->execute([$id]);

        // Redirection après la suppression
        header("Location: livres.php");
        exit;
    } catch (PDOException $error) {
        // Affichage de l'erreur en cas d'échec
        echo "Erreur : " . $error->getMessage();
    }
} else {
    echo "Aucun identifiant de livre spécifié.";
}
?>
