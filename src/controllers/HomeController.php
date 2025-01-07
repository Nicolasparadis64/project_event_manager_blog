<?php

class HomeController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function index($pdo)
    {
        // Récupérer des données depuis la base de données
        $stmt = $pdo->query("SELECT titre, description, date, heure FROM event ORDER BY date ASC");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Passer les données à la vue
        include __DIR__ . '/../views/home.php';
    }
}
