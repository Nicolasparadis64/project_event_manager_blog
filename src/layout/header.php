<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire d'événements</title>
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
        }

        .header-image {
            position: relative;
        }

        .header-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .slide-up {
            transform: translateY(-100%);
            opacity: 0;
        }
    </style>

</head>

<body class="h-full flex flex-col bg-gray-50">
    <nav id="navbar" class="fixed top-0 w-full backdrop-blur-lg bg-white shadow-lg z-10" style="transition: transform 0.3s ease, opacity 0.3s ease">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="?view=home" class="flex items-center text-xl font-bold text-gray-800">
                        EventManager
                    </a>
                   

                    <div class="hidden md:flex md:items-center md:ml-6 space-x-4">
                    <div class="relative group">
                        <button class="text-gray-800 hover:text-gray-900 px-3 py-2 rounded-md focus:outline-none">
                        Événements
                        </button>
                        <div class="absolute left-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 invisible group-hover:visible transition-all duration-300">
                            <a href="?view=events" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Liste événements</a>
                            <?php if ($adminController->isAdmin()): ?>
                                <a href="?view=create" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Créer un événement</a>
                            <?php endif; ?>
                        </div>
                    </div>
                        <?php if ($adminController->isAdmin()): ?>
                                <a href="?view=userList" class='text-gray-800 hover:text-gray-900 px-3 py-2 rounded-md'>User List</a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-center">
                    <?php if (isset($_SESSION['user'])): ?>
                        <div class="flex justify-center flex-row mr-3">
                            <span class="text-gray-800 mr-2"><?= htmlspecialchars($_SESSION['user']['nom']) ?></span>
                            <?php if ($adminController->isAdmin()): ?>
                                <img src="/project_event_manager_blog/public/image/crown.png" alt="Example Image">
                            <?php endif; ?>
                        </div>
                        <a href="?view=logout" class="text-red-600 hover:text-red-800">Déconnexion</a>
                    <?php else: ?>
                        <a href="?view=login" class="text-gray-600 hover:text-gray-900">Connexion</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>


    <main class="flex-1 pt-16">
        <!-- <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 mb-8"> -->