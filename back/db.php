<?php


$host = 'localhost'; // ou l'adresse de votre serveur
$db = 'event_manager'; // Remplacez par le nom de votre base de données
$user = 'nouvel_utilisateur'; // Remplacez par votre nom d'utilisateur
$pass = 'mot_de_passe'; // Remplacez par votre mot de passe

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connexion réussie !";
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/path/to/logfile.log'); // Log erreur
    echo "Une erreur est survenue. Veuillez réessayer plus tard.";
}
?>
