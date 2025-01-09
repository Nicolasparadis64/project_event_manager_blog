<?php

class EventController
{
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../back/config.php';
    }

    public function viewEvents($pdo, $adminController)
    {
        try {
            $stmt = $pdo->query('
                SELECT 
                    e.*,
                    (SELECT COUNT(*) 
                     FROM register r 
                     WHERE r.id_evenement = e.id_evenement) AS inscrit_count
                FROM event e
                ORDER BY e.date, e.heure
            ');
            $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $userId = $_SESSION['user']['id'] ?? null;
        } catch (PDOException $e) {
            die('Erreur lors de la récupération des événements : ' . $e->getMessage());
        }
    
        include $this->config['paths']['views'] . '/events/view.php';
    }
    


    public function createEvent($pdo, $adminController)
    {
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

                    header('Location: ?view=events');
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

    public function deleteEvent($pdo, $adminController)
    {
        if (!$adminController->isAdmin()) {
            http_response_code(403);
            echo 'Accès refusé';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';

            if ($id) {
                try {
                    $stmt = $pdo->prepare('DELETE FROM event WHERE id_evenement = :id');
                    $stmt->execute(['id' => $id]);

                    header('Location: ?view=events');
                    exit();
                } catch (PDOException $e) {
                    die('Erreur lors de la suppression de l\'évènement :' . $e->getMessage());
                }
            }
        }
    }
    public function registerToEvent($pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ?view=login');
            exit();
        }

        $userId = $_SESSION['user']['id'] ?? null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $eventId = $_POST['event_id'] ?? null;

            if ($eventId && $userId) {
                // Check if user is already registered for the event
                $stmt = $pdo->prepare('
                    SELECT COUNT(*) 
                    FROM register 
                    WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement
                ');
                $stmt->execute([
                    'id_utilisateur' => $userId,
                    'id_evenement' => $eventId,
                ]);

                if ($stmt->fetchColumn() > 0) {
                    echo 'Vous êtes déjà inscrit à cet événement.';
                    exit();
                }

                // Proceed with registration
                $stmt = $pdo->prepare('
                    INSERT INTO register (id_utilisateur, id_evenement) 
                    VALUES (:id_utilisateur, :id_evenement)
                ');
                $stmt->execute([
                    'id_utilisateur' => $userId,
                    'id_evenement' => $eventId,
                ]);

                header('Location: ?view=events&success=1');
                exit();
            } else {
                echo 'ID d\'événement ou utilisateur manquant.';
            }
        }
    }


    public function updateEvent($pdo, $adminController)
    {
        if (!$adminController->isAdmin()) {
            http_response_code(403);
            echo 'Accès refusé';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? '';
            $titre = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $date = $_POST['date'] ?? '';
            $heure = $_POST['time'] ?? '';
            $lieu = $_POST['location'] ?? '';

            if ($id && $titre && $description && $date && $heure && $lieu) {
                try {
                    $stmt = $pdo->prepare('
                    UPDATE event 
                    SET titre = :titre, description = :description, date = :date, heure = :heure, lieu = :lieu 
                    WHERE id_evenement = :id
                ');
                    $stmt->execute([
                        'id' => $id,
                        'titre' => $titre,
                        'description' => $description,
                        'date' => $date,
                        'heure' => $heure,
                        'lieu' => $lieu,
                    ]);

                    header('Location: ?view=events');
                    exit();
                } catch (PDOException $e) {
                    die('Erreur lors de la mise à jour de l\'événement : ' . $e->getMessage());
                }
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $eventId = $_GET['id'] ?? '';
            if ($eventId) {
                try {
                    $stmt = $pdo->prepare('SELECT * FROM event WHERE id_evenement = :id');
                    $stmt->execute(['id' => $eventId]);
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($event) {
                        include $this->config['paths']['views'] . '/admin/update.php';
                        return;
                    } else {
                        echo 'Événement introuvable.';
                    }
                } catch (PDOException $e) {
                    die('Erreur lors de la récupération de l\'événement : ' . $e->getMessage());
                }
            } else {
                echo 'ID d\'événement manquant.';
            }
        }
    }

    public function updateStatusUserEvent($event, $pdo) {}
}
