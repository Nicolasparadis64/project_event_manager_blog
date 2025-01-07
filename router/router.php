<?php
$view = $_GET['view'] ?? 'home';

switch ($view) {
    case 'home':
        include 'views/home.php';
        break;
    case 'login':
        include 'views/access/login.php';
        break;
    case 'register':
        include 'views/access/register.php';
        break;
    case 'events' : 
        include 'views/events/view.php';
        break;
    case 'create' : 
        include 'views/events/create.php';
        break;
    case 'logout' : 
        include 'views/access/logout.php';
        break;
    default:
        http_response_code(404);
        include 'views/404.php';
        break;
}
?>
