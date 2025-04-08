<?php

class EventController
{
    private $config;
    private $uploadDir;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../back/config.php';
        $this->uploadDir = __DIR__ . '/../../uploads/events/';
        
        // Créer le répertoire d'upload s'il n'existe pas
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
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
    
        include $this->config['path']['views'] . '/events/view.php';
    }
    
    private function handleImageUpload($file) {
        // Vérifier s'il y a une erreur
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        
        // Vérifier le type de fichier
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception("Type de fichier non autorisé. Seuls JPG, PNG et GIF sont acceptés.");
        }
        
        // Vérifier la taille du fichier (5MB max)
        if ($file['size'] > 5 * 1024 * 1024) {
            throw new Exception("La taille du fichier ne doit pas dépasser 5MB.");
        }
        
        // Générer un nom de fichier unique
        $filename = uniqid() . '_' . basename($file['name']);
        $uploadPath = $this->uploadDir . $filename;
        
        // Déplacer le fichier
        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new Exception("Erreur lors de l'upload du fichier.");
        }
        
        // Retourner le chemin relatif pour stockage en BDD
        return 'uploads/events/' . $filename;
    }

    public function viewEvent($pdo) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $eventId = $_GET['id'] ?? null;
        
            if (!$eventId) {
                echo 'ID d\'événement manquant';
                return;
            }

            try {
                // Récupérer les détails de l'événement
                $stmt = $pdo->prepare('
                    SELECT 
                        e.*,
                        (SELECT COUNT(*) 
                         FROM register r 
                         WHERE r.id_evenement = e.id_evenement) AS inscrit_count
                    FROM event e
                    WHERE e.id_evenement = :id
                ');
                $stmt->execute(['id' => $eventId]);
                $event = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if (!$event) {
                    echo 'Événement introuvable.';
                    return;
                }
                
                // Vérifier si l'utilisateur est inscrit à cet événement
                $isRegistered = false;
                if (isset($_SESSION['user'])) {
                    $stmt = $pdo->prepare('
                        SELECT COUNT(*) 
                        FROM register 
                        WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement
                    ');
                    $stmt->execute([
                        'id_utilisateur' => $_SESSION['user']['id'],
                        'id_evenement' => $eventId,
                    ]);
                    $isRegistered = $stmt->fetchColumn() > 0;
                }
                
                // Charger la vue détaillée
                include $this->config['paths']['views'] . '/events/view_event.php';
                
            } catch (PDOException $e) {
                die('Erreur lors de la récupération de l\'événement : ' . $e->getMessage());
            }
        }
        
    }

    public function createEvent($pdo, $adminController)
    {
        if (!$adminController->isAdmin()) {
            http_response_code(403);
            header('Location: ?view=login');
            // echo 'Accès refusé';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $date = $_POST['date'] ?? '';
            $heure = $_POST['time'] ?? '';
            $lieu = $_POST['location'] ?? '';
            $imagePath = null;
            
            // Traiter l'upload d'image si un fichier est fourni
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                try {
                    $imagePath = $this->handleImageUpload($_FILES['image']);
                } catch (Exception $e) {
                    echo 'Erreur: ' . $e->getMessage();
                    include $this->config['paths']['views'] . '/admin/create.php';
                    return;
                }
            }

            if ($titre && $description && $date && $heure && $lieu) {
                try {
                    $stmt = $pdo->prepare('INSERT INTO event (titre, description, date, heure, lieu, image_path) VALUES (:titre, :description, :date, :heure, :lieu, :image_path)');
                    $stmt->execute([
                        'titre' => $titre,
                        'description' => $description,
                        'date' => $date,
                        'heure' => $heure,
                        'lieu' => $lieu,
                        'image_path' => $imagePath
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
        include $this->config['path']['views'] . '/admin/create.php';
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
                    // Récupérer le chemin de l'image avant de supprimer l'événement
                    $stmt = $pdo->prepare('SELECT image_path FROM event WHERE id_evenement = :id');
                    $stmt->execute(['id' => $id]);
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Supprimer l'événement
                    $stmt = $pdo->prepare('DELETE FROM event WHERE id_evenement = :id');
                    $stmt->execute(['id' => $id]);
                    
                    // Supprimer l'image associée si elle existe
                    if ($event && !empty($event['image_path'])) {
                        $fullPath = __DIR__ . '/../../' . $event['image_path'];
                        if (file_exists($fullPath)) {
                            unlink($fullPath);
                        }
                    }

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

    public function unRegisterToEvent($pdo) {
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
                try {
                    $stmt = $pdo->prepare('
                    DELETE FROM register
                    WHERE id_utilisateur = :id_utilisateur AND id_evenement = :id_evenement');
                    $stmt->execute([
                        'id_utilisateur' => $userId,
                        'id_evenement' => $eventId,
                    ]);

                    header('Location: ?view=events&success=1');
                    exit();
                } catch (PDOException $e) {
                    die('Erreur lors de la suppression de l\'inscription : ' . $e->getMessage());
                }
            } else {
                echo 'Id d\événement ou utilisateur manquand';
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
            
            // Récupérer l'image actuelle
            $stmt = $pdo->prepare('SELECT image_path FROM event WHERE id_evenement = :id');
            $stmt->execute(['id' => $id]);
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
            $imagePath = $event['image_path'] ?? null;
            
            // Traiter le nouvel upload d'image si fourni
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                try {
                    // Supprimer l'ancienne image si elle existe
                    if (!empty($imagePath)) {
                        $fullPath = __DIR__ . '/../../' . $imagePath;
                        if (file_exists($fullPath)) {
                            unlink($fullPath);
                        }
                    }
                    
                    // Traiter la nouvelle image
                    $imagePath = $this->handleImageUpload($_FILES['image']);
                } catch (Exception $e) {
                    echo 'Erreur: ' . $e->getMessage();
                    // Réafficher le formulaire
                    $stmt = $pdo->prepare('SELECT * FROM event WHERE id_evenement = :id');
                    $stmt->execute(['id' => $id]);
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);
                    include $this->config['paths']['views'] . '/admin/update.php';
                    return;
                }
            }

            if ($id && $titre && $description && $date && $heure && $lieu) {
                try {
                    $stmt = $pdo->prepare('
                    UPDATE event 
                    SET titre = :titre, description = :description, date = :date, heure = :heure, lieu = :lieu, image_path = :image_path 
                    WHERE id_evenement = :id
                ');
                    $stmt->execute([
                        'id' => $id,
                        'titre' => $titre,
                        'description' => $description,
                        'date' => $date,
                        'heure' => $heure,
                        'lieu' => $lieu,
                        'image_path' => $imagePath
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
                        include $this->config['path']['views'] . '/admin/update.php';
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