<?php
$pdo = require_once 'back/db.php'; 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'src/controllers/AdminController.php';

$adminController = new AdminController($pdo);

$view = $_GET['view'] ?? 'home';

$skipHeaderFooter = ($view === 'login' || $view === 'register');

if (!$skipHeaderFooter) {
    require_once 'src/layout/header.php';
}
?>

<main class="<?php echo $skipHeaderFooter ? 'h-screen' : 'flex-1'; ?>">
    <?php require_once 'src/router/router.php'; ?>
</main>

<?php
if (!$skipHeaderFooter) {
    require_once 'src/layout/footer.php';
}
?>