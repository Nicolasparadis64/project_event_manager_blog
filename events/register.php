<?php
require '../header.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    try {
        // Vérifier si l'utilisateur est déjà inscrit
        $checkStmt = $pdo->prepare("
            SELECT COUNT(*) FROM register 
            WHERE id_utilisateur = ? AND id_evenement = ?
        ");
        $checkStmt->execute([$data->id_utilisateur, $data->id_evenement]);
        
        if ($checkStmt->fetchColumn() > 0) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Vous êtes déjà inscrit à cet événement'
            ]);
            exit;
        }
        
        // Inscrire l'utilisateur
        $stmt = $pdo->prepare("
            INSERT INTO register (id_utilisateur, id_evenement, id_organisateur) 
            VALUES (?, ?, ?)
        ");
        
        if ($stmt->execute([
            $data->id_utilisateur,
            $data->id_evenement,
            $data->id_organisateur
        ])) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Inscription réussie'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de l\'inscription: ' . $e->getMessage()
        ]);
    }
}
?>