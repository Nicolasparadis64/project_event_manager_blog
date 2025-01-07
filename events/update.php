<?php
require '../header.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $data = json_decode(file_get_contents("php://input"));
    
    try {
        $stmt = $pdo->prepare("
            UPDATE event 
            SET titre = ?, description = ?, date = ?, heure = ?, lieu = ?
            WHERE id_evenement = ?
        ");
        
        if ($stmt->execute([
            $data->titre,
            $data->description,
            $data->date,
            $data->heure,
            $data->lieu,
            $data->id_evenement
        ])) {
            // Mettre à jour l'emplacement
            $stmtLieu = $pdo->prepare("
                UPDATE Avoir 
                SET id_lieu = ? 
                WHERE id_evenement = ?
            ");
            $stmtLieu->execute([$data->id_lieu, $data->id_evenement]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Événement mis à jour avec succès'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la mise à jour: ' . $e->getMessage()
        ]);
    }
}
?>