<?php
require '../header.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    try {
        $stmt = $pdo->prepare("INSERT INTO event (titre, description, date, heure, lieu) VALUES (?, ?, ?, ?, ?)");
        
        if ($stmt->execute([
            $data->titre,
            $data->description,
            $data->date,
            $data->heure,
            $data->lieu
        ])) {
            $eventId = $pdo->lastInsertId();
            
            // Ajouter l'emplacement dans la table Avoir
            $stmtLieu = $pdo->prepare("INSERT INTO Avoir (id_lieu, id_evenement) VALUES (?, ?)");
            $stmtLieu->execute([$data->id_lieu, $eventId]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Événement créé avec succès',
                'id' => $eventId
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la création: ' . $e->getMessage()
        ]);
    }
}
?>