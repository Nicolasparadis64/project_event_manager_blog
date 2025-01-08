<?php

class AuthController
{
    private $config;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../../back/config.php';
    }

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
                    'email' => $user['email'],
                    'role' => $user['role'],
                ];
                header('Location: ?view=home');
                exit();
            } else {
                $error = 'Nom ou mot de passe invalide';
            }
        }
        include $this->config['paths']['views'] . '/access/login.php';
    }

    public function register($pdo)
    {
        require_once 'back/db.php';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $mot_de_passe = $_POST['mot_de_passe'] ?? '';
            $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'] ?? '';
    
            if (empty($nom) || empty($prenom) || empty($email) || empty($mot_de_passe) || empty($confirmation_mot_de_passe)) {
                $error = 'Tous les champs sont requis.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Adresse email invalide.';
            } elseif ($mot_de_passe !== $confirmation_mot_de_passe) {
                $error = 'Les mots de passe ne correspondent pas.';
            } else {
                $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                $stmt->execute(['email' => $email]);
                $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
                if ($existingUser) {
                    $error = 'Un utilisateur avec cet email existe déjà.';
                } else {
                    $hashedPassword = password_hash($mot_de_passe, PASSWORD_BCRYPT);
    
                    $stmt = $pdo->prepare("INSERT INTO user (nom, prenom, email, mot_de_passe, date_inscription) VALUES (:nom, :prenom, :email, :mot_de_passe, NOW())");
                    $success = $stmt->execute([
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'email' => $email,
                        'mot_de_passe' => $hashedPassword,
                    ]);
    
                    if ($success) {
                        header('Location: ?view=login');
                        exit();
                    } else {
                        $error = 'Erreur lors de l\'enregistrement de l\'utilisateur.';
                    }
                }
            }
        }
    
        include $this->config['paths']['views'] . '/access/register.php';
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
