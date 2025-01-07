<?php
$view = $_GET['view'] ?? 'home';

switch ($view) {
    case 'home':
        include 'src/views/home.php';
        break;
    case 'login':
        include 'src/views/access/login.php';
        break;
    case 'register':
        include 'src/views/access/register.php';
        break;
    case 'events' : 
        include 'src/views/events/view.php';
        break;
    case 'create' : 
        include 'src/views/events/create.php';
        break;
    case 'logout' : 
        include 'src/views/access/logout.php';
        break;
    default:
        http_response_code(404);
        include 'src/views/404.php';
        break;
}
?>
