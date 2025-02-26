<?php if ($_GET['view'] === 'login' || $_GET['view'] === 'register'): ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire d'événements - Connexion</title>
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: rgb(249 250 251);
        }
    </style>
</head>
<body class="h-full flex flex-col min-h-screen">
<?php endif; ?>

<div class="container flex mx-auto px-4 sm:px-6 lg:px-8 py-8 h-full justify-center items-center">
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
            <button type="submit" class="w-full justify-center border border-transparent inline shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 px-4 py-2 rounded">Se connecter</button>
        </form>
        <p class="mt-4 text-center">
            <a href="?view=register" class="inline-block align-baseline font-bold text-sm text-gray-700 hover:text-gray-900">Inscription</a>
        </p>
        <p class="mt-2 text-center">
            <a href="?view=home" class="inline-block align-baseline font-bold text-sm text-blue-600 hover:text-blue-800">Retour à l'accueil</a>
        </p>
    </div>
</div>

<?php if ($_GET['view'] === 'login' || $_GET['view'] === 'register'): ?>
</body>
</html>
<?php endif; ?>