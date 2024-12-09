<?php
// Démarrage de la session pour gérer la connexion des utilisateurs
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliothèque en ligne</title>
    <script src="script.js" defer></script>
    <link rel="stylesheet" href="https://bootswatch.com/5/quartz/bootstrap.min.css">
    <link rel="stylesheet" href="./style.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>
    
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark shadow-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Bibliothèque en ligne</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="livres.php">Livres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ajout_livre.php">Ajouter un livre</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Section pour les liens de connexion/déconnexion -->
        <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="deconnexion.php" class="nav-link">Se déconnecter</a></li>
            <?php else: ?>
                <li><a href="connexion.php" class="nav-link">Se connecter</a></li>
                <li><a href="inscription.php" class="nav-link">S'inscrire</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    
    <!-- Section de recherche -->
    <div class="search-form">
    <input type="text" class="search-input" placeholder="Recherche un livre...">
    <button class="search-button">Rechercher</button>
</div>

</body>
</html>
