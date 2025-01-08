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
        $stmt = $pdo->query("SELECT titre, description, date, heure FROM event ORDER BY date ASC");
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include $this->config['paths']['views'] . '/home.php';
    }
}
