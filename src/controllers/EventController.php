<?php

class EventController
{
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../back/config.php';
    }
    
    public function viewEvents($pdo)
    {
        require_once $this->config['paths']['back'] . '/db.php';

        try {
            $stmt = $pdo->query('SELECT * FROM event ORDER BY date, heure');
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des événements : ' . $e->getMessage());
        }

        include $this->config['paths']['views'] . '/events/view.php';

    }

    public function createEvent($pdo)
    {
        require_once $this->config['paths']['back'] . '/db.php';
        require_once $this->config['paths']['controllers'] . '/AdminController.php';

        $adminController = new AdminController();
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!$adminController->isAdmin()) { 
            http_response_code(403);
            echo 'Accès refusé';
            exit();
        }

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

                    header(header: 'Location: ?view=events');
                    exit();
                } catch (PDOException $e) {
                    die('Erreur lors de la création de l\'événement : ' . $e->getMessage());
                }
            } else {
                echo 'Tous les champs sont requis.';
            }
        }
        include $this->config['paths']['views'] . '/admin/create.php';
    }
}
