<?php

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/EventController.php';
require_once __DIR__ . '/../../back/db.php';

$view = $_GET['view'] ?? 'home';

try {
    switch ($view) {
        case 'home':
            $controller = new HomeController($pdo);
            $controller->index($pdo);
            break;

        case 'login':
            $controller = new AuthController();
            $controller->login($pdo);
            break;

        case 'register':
            $controller = new AuthController();
            $controller->register($pdo);
            break;

        case 'events':
            $controller = new EventController();
            $controller->viewEvents($pdo, $adminController);
            break;

        case 'create':
            $controller = new EventController();
            $controller->createEvent($pdo, $adminController);
            break;

        case 'delete':
            $controller = new EventController();
            $controller->deleteEvent($pdo, $adminController);
            break;

        case 'logout':
            $controller = new AuthController();
            $controller->logout($pdo);
            break;

        default:
            http_response_code(404);
            include __DIR__ . '/../views/404.php';
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Internal Server Error: " . $e->getMessage();
}
