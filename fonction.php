<?php
// Fonction pour sécuriser les données des formulaires (éviter les injections XSS)
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Fonction pour hacher le mot de passe avant de l'enregistrer dans la base de données
function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Fonction pour vérifier le mot de passe lors de la connexion
function verify_password($password, $hash) {
    return password_verify($password, $hash);
}

// Fonction pour vérifier si un utilisateur est déjà connecté
function is_logged_in() {
    return isset($_SESSION['user']);
}

// Fonction pour obtenir la connexion à la base de données
function get_db_connection() {
    // Changez ces valeurs avec celles de votre propre configuration
    $host = 'localhost';
    $db = 'book';
    $user = 'root';
    $pass = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}

// Fonction pour vérifier l'existence d'un utilisateur dans la base de données
function check_user_exists($email) {
    $pdo = get_db_connection();
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
