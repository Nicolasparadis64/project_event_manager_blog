<?php
require_once 'back/db.php'; 
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'layout/header.php';
require_once 'router/router.php';
require_once 'layout/footer.php';
?>
