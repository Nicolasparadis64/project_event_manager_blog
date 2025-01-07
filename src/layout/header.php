<!DOCTYPE html>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire d'événements</title>
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    </head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="?view=home" class="flex items-center text-xl font-bold text-gray-800">
                        EventManager
                    </a>
                    <div class="hidden md:flex md:items-center md:ml-6 space-x-4">
                        <a href="?view=events" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md">Événements</a>
                        <a href="?view=create" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md">Créer</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <?php if (isset($_SESSION['user'])): ?>
                        <span class="text-gray-600 mr-4"><?= htmlspecialchars($_SESSION['user']['nom']) ?></span>
                        <a href="?view=logout" class="text-red-600 hover:text-red-800">Déconnexion</a>
                    <?php else: ?>
                        <a href="?view=login" class="text-gray-600 hover:text-gray-900">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">