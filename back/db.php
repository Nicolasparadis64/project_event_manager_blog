<?php
$config = require __DIR__ . '/../back/config.php';

$host = $config['db']['host'];
$db = $config['db']['dbname'];
$user = $config['db']['user'];
$pass = $config['db']['password'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Test de connexion
    $stm = $pdo->prepare('SELECT * FROM user');
    $stm->execute();
    $users = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    return $pdo; // Retourner la connexion PDO
    
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/path/to/logfile.log');
    echo "Une erreur est survenue. Veuillez réessayer plus tard.";
    die(); // Arrêter l'exécution si la connexion échoue
}