<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'header.php';
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT); 

    $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, mot_de_passe, date_inscription) VALUES (?, ?, ?, ?, NOW())");
    if ($stmt->execute([$nom, $prenom, $email, $mot_de_passe])) {
        echo json_encode(['status' => 'success', 'message' => 'Utilisateur enregistré avec succès.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erreur lors de l\'enregistrement.']);
    }
}
?>
