<?php

class AdminController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo; 
    }

    // public function isAdmin() {
    //     if (session_status() === PHP_SESSION_NONE) {
    //         session_start();
    //     }
    //     if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    //         header('Location: ?view=login');
    //         exit;
    //     }
    //     return true;
    // }

    public function isAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
    

    public function listUsers() {
        if (!$this->isAdmin()) {
            header('Location: ?view=login');
            exit;
        }

        try {
            $stmt = $this->pdo->prepare("SELECT id_utilisateur, nom, email, role, date_inscription FROM user");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            throw $e;
        }
    }

    public function createUser($data) {
        if (!$this->isAdmin()) {
            header('Location: ?view=login');
            exit;
        }
    
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO user 
                (nom, prenom, email, mot_de_passe, role, date_inscription) 
                VALUES 
                (:nom, :prenom, :email, :password, :role, NOW())
            ");
    
            $params = [
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'role' => $data['role']
            ];
    
            $stmt->execute($params);
            
            header('Location: ?view=userList');
            exit;
        } catch (PDOException $e) {
            error_log("Erreur SQL : " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteUser($id) {
        if (!$this->isAdmin()) {
            header('Location: ?view=login');
            exit;
        }

        $stmt = $this->pdo->prepare("DELETE FROM user WHERE id_utilisateur = :id");
        $stmt->execute(['id' => $id]);
        header('Location: ?view=userList');
        exit;
    }

    public function updateUser($id, $data) {
        if (!$this->isAdmin()) {
            header('Location: ?view=login');
            exit;
        }

        $stmt = $this->pdo->prepare("UPDATE user SET nom = :nom, email = :email, role = :role WHERE id_utilisateur = :id");
        $stmt->execute([
            'id' => $id,
            'nom' => $data['nom'],
            'email' => $data['email'],
            'role' => $data['role']
        ]);

        header('Location: ?view=userList');
        exit;
    }
}

?>
