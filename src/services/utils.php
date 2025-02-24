<?php 

function checkAuthentication() {
    if (!isset($_SESSION['user'])) {
        header('Location: ?view=login');
        exit();
    }
}


?>