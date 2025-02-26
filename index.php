<?php
$pdo = require_once 'back/db.php'; 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'src/controllers/AdminController.php';

$adminController = new AdminController($pdo);

require_once 'src/layout/header.php';
?>

<main class="flex-1 pt-16">

    <?php require_once 'src/router/router.php'; ?>

</main>

<?php
require_once 'src/layout/footer.php';
?>