<?php

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/EventController.php';
// require_once __DIR__ . '/../../back/db.php';

$view = $_GET['view'] ?? 'home';


try {
    switch ($view) {
        case 'home':
            
            $controller = new HomeController($pdo);
            $controller->index($pdo);
            break;

        case 'login':
            if (isset($_SESSION['user'])) {
                header('location: ?view=home');
                exit();
            }

            $controller = new AuthController();
            $controller->login($pdo);
            break;

        case 'register':
            $controller = new AuthController();
            $controller->register($pdo);
            break;

        case 'register_event':
            $controller = new EventController();
            $controller->registerToEvent($pdo);
            break;

        case 'unregister_event':
            $eventController = new EventController();
            $eventController->unRegisterToEvent($pdo);
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

        case 'update_event':
            $controller = new EventController();
            $controller->updateEvent($pdo, $adminController);
            break;

            case 'userList':
                $controller = new AdminController($pdo);
                $controller->listUsers();
                include __DIR__ . '/../views/admin/userList.php'; 
                break;
            
            case 'createUser':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller = new AdminController($pdo);
                    $controller->createUser($_POST);
                } else {
                    include __DIR__ . '/../views/admin/createUser.php'; 
                }
                break;
            
            case 'deleteUser':
                if (isset($_GET['id'])) {
                    $controller = new AdminController($pdo);
                    $controller->deleteUser($_GET['id']);
                }
                break;
            
            case 'updateUser':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
                    $controller = new AdminController($pdo);
                    $controller->updateUser($_GET['id'], $_POST);
                } else {
                    include __DIR__ . '/../views/admin/updateUser.php';
                }
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
