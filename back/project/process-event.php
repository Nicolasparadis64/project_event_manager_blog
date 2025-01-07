<?php
require_once 'back/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';
    $heure = $_POST['time'] ?? '';
    $lieu = $_POST['location'] ?? '';

    if ($titre && $description && $date && $heure && $lieu) {
        try {
            $stmt = $pdo->prepare('INSERT INTO event (titre, description, date, heure, lieu) VALUES (:titre, :description, :date, :heure, :lieu)');
            $stmt->execute([
                'titre' => $titre,
                'description' => $description,
                'date' => $date,
                'heure' => $heure,
                'lieu' => $lieu,
            ]);

            // Redirection après ajout
            header('Location: ?view=events');
            exit();
        } catch (PDOException $e) {
            die('Erreur lors de la création de l\'événement : ' . $e->getMessage());
        }
    } else {
        echo 'Tous les champs sont requis.';
    }
}
?>
