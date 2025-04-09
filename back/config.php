<?php

// Charger les variables d'environnement depuis le fichier .env
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
}

return [
    'db' => [
        'host' => $_ENV['DB_HOST'] ?? 'db',
        'dbname' => $_ENV['DB_NAME'] ?? 'event_manager',
        'user' => $_ENV['DB_USER'] ?? 'your_db_user',
        'password' => $_ENV['DB_PASSWORD'] ?? 'your_db_password',
    ],
    'paths' => [
        'root' => __DIR__,  
        'views' => __DIR__ . '/../src/views',
        'controllers'=> __DIR__ . '/../src/controllers',
        'includes' => __DIR__ . '/../includes',
        'back' => __DIR__ . '/../back',
    ]
];

// define('BASE_URL' . '');
?>
