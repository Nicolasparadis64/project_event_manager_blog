<?php

class HomeController
{
    private $pdo;
    private $config;
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->config = require __DIR__ . '/../../back/config.php';
    }

    public function index($pdo)
    {
        // $stmt = $pdo->query("SELECT e.titre, e.description, e.date, e.heure, u.nom, u.prenom,             
        // (SELECT COUNT(*) FROM register r WHERE r.id_evenement = e.id_evenement) AS inscrit_count 
        //                      FROM event e
        //                      LEFT JOIN register r ON e.id_evenement = r.id_evenement
        //                      LEFT JOIN user u ON r.id_utilisateur = u.id_utilisateur
        //                      ORDER BY e.date ASC");
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

        // error_log("Route demandée : $view", 3, '/path/to/debug.log');
        include $this->config['paths']['views'] . '/home.php';
    }
    
    
}
