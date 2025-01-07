<?php
require '../header.php';
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->prepare("
            SELECT e.*, l.ville, l.adresse, l.code_postal 
            FROM event e 
            LEFT JOIN Avoir a ON e.id_evenement = a.id_evenement
            LEFT JOIN lieu l ON a.id_lieu = l.id_lieu
        ");
        $stmt->execute();
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'status' => 'success',
            'events' => $events
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Erreur lors de la récupération: ' . $e->getMessage()
        ]);
    }
}
?>