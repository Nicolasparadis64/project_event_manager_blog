<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'back/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $date = $_POST['date'] ?? '';
    $heure = $_POST['time'] ?? '';
    $lieu = $_POST['location'] ?? '';

    if ($titre && $description && $date && $heure && $lieu) {
        try {
            $stmt = $pdo->prepare('INSERT INTO event (titre, description, date, heure, lieu) VALUES (:titre, :description, :date, :heure, :lieu)');
            $stmt->execute([
                'titre' => $titre,
                'description' => $description,
                'date' => $date,
                'heure' => $heure,
                'lieu' => $lieu,
            ]);

            // Redirection après ajout
            header(header: 'Location: ?view=events');
            exit();
        } catch (PDOException $e) {
            die('Erreur lors de la création de l\'événement : ' . $e->getMessage());
        }
    } else {
        echo 'Tous les champs sont requis.';
    }
}

?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
        <?php 
        echo $_SESSION['error']; 
        unset($_SESSION['error']); 
        ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
        <?php 
        echo $_SESSION['success']; 
        unset($_SESSION['success']); 
        ?>
    </div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center mb-8">Créer un nouvel événement</h1>
        
        <div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
            <div class="p-8">
                <form action="" method="POST" class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                        <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                    </div>
                    
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700">Heure</label>
                        <input type="time" name="time" id="time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                        <input type="text" name="location" id="location" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>
                    
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Créer l'événement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>