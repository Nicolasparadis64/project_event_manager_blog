<?php

class AdminController {
    
    public function isAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
}

?>