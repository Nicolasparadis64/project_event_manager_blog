<?php

class AuthController
{
    public function login($pdo)
    {
        require_once 'back/db.php';
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $mot_de_passe = $_POST['mot_de_passe'] ?? '';

            $stmt = $pdo->prepare("SELECT * FROM user WHERE nom = :nom");
            $stmt->execute(['nom' => $nom]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
                $_SESSION['user'] = [
                    'id' => $user['id_user'],
                    'nom' => $user['nom'],
                    'email' => $user['email']
                ];
                header('Location: ?view=home');
                exit();
            } else {
                $error = 'Nom ou mot de passe invalide';
            }
        }
        include __DIR__ . '/../views/access/login.php';
    }

    public function register($pdo)
    {
        include __DIR__ . '/../views/access/register.php';
    }

    public function logout($pdo)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();

        session_destroy();

        header('Location: ?view=home');
        exit();
    }
}
