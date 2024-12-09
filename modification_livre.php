<?php
include "./header.php";
include "./fonction.php";
require "./DB.php";

$error = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparation et exécution de la requête
    $query = $pdo->prepare("SELECT * FROM livres WHERE id_livre = ?");
    $query->execute([$id]);
    $livre = $query->fetch();

    // Vérification si le livre existe
    if (!$livre) {
        echo "Livre non trouvé.";
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titre = strip_tags($_POST['titre']);
        $auteur = strip_tags($_POST['auteur']);
        $categorie = strip_tags($_POST['categorie']);

        // Vérification des champs
        if (empty($titre)) {
            $error .= "<p>Le Titre est obligatoire.</p>";
        } elseif (strlen($titre) < 2 || strlen($titre) > 100) {
            $error .= "<p>Le Titre n'est pas conforme (2 à 100 caractères).</p>";
        }

        if (empty($auteur)) {
            $error .= "<p>L'Auteur est obligatoire.</p>";
        } elseif (strlen($auteur) < 2 || strlen($auteur) > 50) {
            $error .= "<p>L'Auteur n'est pas conforme (2 à 50 caractères).</p>";
        }

        if (empty($categorie)) {
            $error .= "<p>La Catégorie est obligatoire.</p>";
        } elseif (strlen($categorie) < 2 || strlen($categorie) > 50) {
            $error .= "<p>La Catégorie n'est pas conforme (2 à 50 caractères).</p>";
        }

        // Si aucune erreur, mise à jour du livre
        if (empty($error)) {
            $updateQuery = $pdo->prepare("UPDATE livres SET titre = ?, auteur = ?, categorie = ? WHERE id_livre = ?");
            $updateQuery->execute([$titre, $auteur, $categorie, $id]);

            header("Location: livres.php");
            exit;
        }
    }
} else {
    echo "Aucun identifiant de livre spécifié.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Livre</title>
</head>
<body>

<?php if (!empty($error)) { ?>
    <div style="color: red;">
        <h4>Erreur(s) :</h4>
        <?= $error ?>
    </div>
<?php } ?>

<form action="modification_livre.php?id=<?= htmlspecialchars($livre['id_livre']) ?>" method="POST">
    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required>

    <label for="auteur">Auteur</label>
    <input type="text" name="auteur" id="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required>

    <label for="categorie">Catégorie</label>
    <input type="text" name="categorie" id="categorie" value="<?= htmlspecialchars($livre['categorie']) ?>" required>

    <button type="submit">Modifier</button>
</form>

</body>
</html>
