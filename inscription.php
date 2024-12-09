<?php
// Connexion à la base de données
include "./header.php";
include "./fonction.php";
require "./DB.php";

// Variable pour les erreurs
$erreurs = [];

// Initialisation des variables pour éviter les erreurs d'undefined
$nom = $prenom = $email = $date_naissance = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire et nettoyage
    $nom = trim($_POST['nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $date_naissance = $_POST['date_naissance'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';

    // Validation des champs
    if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }
    if (empty($prenom)) {
        $erreurs[] = "Le prénom est obligatoire.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email est obligatoire et doit être valide.";
    }
    if (empty($date_naissance)) {
        $erreurs[] = "La date de naissance est obligatoire.";
    }
    if (empty($motdepasse) || strlen($motdepasse) < 8) {
        $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    // Si aucune erreur, procéder à l'insertion dans la base de données
    if (empty($erreurs)) {
        // Hachage du mot de passe
        $motdepasse_hache = password_hash($motdepasse, PASSWORD_DEFAULT);

        try {
            // Préparation et exécution de la requête
            $query = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, email, motdepasse, date_naissance) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$nom, $prenom, $email, $motdepasse_hache, $date_naissance]);

            // Redirection après inscription
            header("Location: connexion.php");
            exit();
        } catch (PDOException $e) {
            $erreurs[] = "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>

<body>
    <form id="formulaire" action="inscription.php" method="POST">
        <div>
            <label class="form-label mt-4">Nom</label>
            <input type="text" class="form-control" name="nom" id="nom" value="<?= htmlspecialchars($nom) ?>" required placeholder="Nom">
        </div>

        <div>
            <label class="form-label mt-4">Prénom</label>
            <input type="text" class="form-control" name="prenom" id="prenom" value="<?= htmlspecialchars($prenom) ?>" required placeholder="Prénom">
        </div>

        <div>
            <label class="form-label mt-4">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required placeholder="Email">
        </div>

        <div>
            <label class="form-label mt-4">Date de naissance</label>
            <input type="date" class="form-control" name="date_naissance" id="date_naissance" value="<?= htmlspecialchars($date_naissance) ?>" required>
        </div>

        <div>
            <label class="form-label mt-4">Mot de passe</label>
            <input type="password" class="form-control" name="motdepasse" id="motdepasse" required placeholder="Mot de passe">
        </div>

        <button type="submit" class="btn btn-primary mt-4">S'inscrire</button>

        <?php if (!empty($erreurs)): ?>
            <div class="alert alert-warning mt-4">
                <ul>
                    <?php foreach ($erreurs as $erreur): ?>
                        <li><?= htmlspecialchars($erreur) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </form>

    <?php include "./footer.php"; ?>
</body>

</html>
