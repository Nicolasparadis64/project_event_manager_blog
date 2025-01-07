<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'back/db.php';

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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h1 class="text-2xl font-bold mb-6">Connexion</h1>
            <?php if (isset($error)): ?>
                <p class="text-red-500 text-sm mb-4"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">Nom</label>
                    <input id="nom" type="text" name="nom" class="w-full p-2 border rounded" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mot_de_passe">Mot de passe</label>
                    <input id="mot_de_passe" type="password" name="mot_de_passe" class="w-full p-2 border rounded" required>
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded w-full">Se connecter</button>
            </form>
        </div>
    </div>
</body>
</html>
