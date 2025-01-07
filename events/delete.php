<?php
require '../header.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"));
    
    try {
        // Supprimer d'abord les références dans la table Avoir
        $stmtAvoir = $pdo->prepare("DELETE FROM Avoir WHERE id_evenement = ?");
        $stmtAvoir->execute([$data->id_evenement]);
        
        // Supprimer les inscriptions
        $stmtRegister = $pdo->prepare("DELETE FROM register WHERE id_evenement = ?");
        $stmtRegister->execute([$data->id_evenement]);
        
        // Supprimer l'événement
        $stmtEvent = $pdo->prepare("DELETE FROM event WHERE id_evenement = ?");
        if ($stmtEvent->execute([$data->id_evenement])) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Événement supprimé avec succès'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
        ]);
    }
}
?>