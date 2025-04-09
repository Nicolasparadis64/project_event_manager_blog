<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'header.php';
include 'db.php'; 

$data = json_decode(file_get_contents("php://input"));

if (isset($data->nom) && isset($data->password)) { 
    $nom = $data->nom;
    $password = $data->password;

    $stmt = $pdo->prepare("SELECT * FROM user WHERE nom = :nom");
    $stmt->execute(['nom' => $nom]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) { 
        echo json_encode(['success' => true, 'user' => $user]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nom ou mot de passe invalide']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Nom et mot de passe sont requis']);
}
?>
