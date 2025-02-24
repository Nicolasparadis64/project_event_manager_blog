<?php
require '../header.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    
    try {
        if (!isset($data->titre) || !isset($data->description) || !isset($data->data) || !isset($data->heure) || !isset($data->lieu) || !isset($data->id_lieu))
        throw new Exception('Donnés manquantes');

        $titre = htmlspecialchars(strip_tags($data->titre));
        $description = htmlspecialchars(strip_tags($data->$description));
        $date = htmlspecialchars(strip_tags($data->description));
        $heure = htmlspecialchars(strip_tags($data->description));
        $lieu = htmlspecialchars(strip_tags($data->$lieu));
        $id_lieu = htmlspecialchars(strip_tags($data->$id_lieu));

        $stmt = $pdo->prepare(" INSERT INTO event (titre, description, date, heure, lieu) 
            VALUES (:titre, :description, :date, :heure, :lieu)");

        $stmt->bindParam(':titre', $titre, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':heure', $heure, PDO::PARAM_STR);
        $stmt->bindParam(':lieu', $lieu, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            $eventId = $pdo->lastInsertId();
            
            $stmtLieu = $pdo->prepare("INSERT INTO Avoir (id_lieu, id_evenement) VALUES (:id_lieu, : id_evenement)");
            $stmtLieu->bindParam(':id_lieu', $id_lieu, PDO::PARAM_INT);
            $stmtLieu->bindParam(':id_evenement', $eventId, PDO::PARAM_INT);
            $stmtLieu->execute();
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Événement créé avec succès',
                'id' => $eventId
            ]);
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la création: ' . $e->getMessage()
        ]);
    }
}
?>