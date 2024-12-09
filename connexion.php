<?php

include "./header.php";
include "./fonction.php";
require "./DB.php";

// Simulation : Mot de passe d'origine défini
$motdepasse = "azerty";

// Création d'un hash pour le mot de passe d'origine (enregistré dans une base, par exemple)
$hash = password_hash($motdepasse, PASSWORD_DEFAULT);


if (isset($_POST['connexion'])) {
    // Récupération du mot de passe saisi par l'utilisateur
    $motdepasseSaisi = $_POST['mdp'];
    
    // On ne doit PAS recréer un nouveau hash ici, on vérifie simplement
    // le mot de passe saisi par rapport au hash déjà créé
    if (password_verify($motdepasseSaisi, $hash)) {
        echo "Connexion réussie";
    } else {
        echo "Connexion échouée";
    }
    
}

?>
<a href="inscription.php">Déconnexion</a>
<!-- Formulaire -->
<form action="" method="post">
    
    <input type="text" name="mail" placeholder="Email">
    <input type="password" name="mdp" placeholder="Mot de passe">
    <button type="submit" name="connexion">Connexion</button>
  
</form>

