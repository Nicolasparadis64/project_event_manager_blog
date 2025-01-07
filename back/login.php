<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'header.php';
include 'db.php'; // Assurez-vous que ce fichier contient votre connexion PDO.

$data = json_decode(file_get_contents("php://input"));

if (isset($data->nom) && isset($data->password)) { // Vérifiez directement les propriétés de l'objet $data
    $nom = $data->nom;
    $password = $data->password;

    // Préparer la requête SQL pour vérifier l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM user WHERE nom = :nom");
    $stmt->execute(['nom' => $nom]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) { // Assurez-vous que le mot de passe est haché dans la DB
        // Si l'authentification est réussie, renvoyer les informations de l'utilisateur
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nom ou mot de passe invalide']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nom et mot de passe sont requis']);
}
?>
