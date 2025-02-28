<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire d'événements</title>
    <link href="/css/style.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
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
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url(/project_event_manager_blog/public/image/conference2.jpg);
        }

        .header-image::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .slide-up {
            transform: translateY(-100%);
            opacity: 0;
        }

        .heading-1 {
            position: relative;
            z-index: 2;

            font-size: 3rem;
            font-weight: 700;
            text-align: center;
            margin: 4rem auto;
            max-width: 80%;
            line-height: 1.2;
        }

        .heading-1 span:first-child {
            color: white;
        }

        #typed {
            color: #3182ce;
            font-weight: 700;
        }

        .typed-cursor {
            font-size: 3rem;
            color: #3182ce;
        }

        .event-card {
            display: flex;
            flex-direction: column;
        }

        .container {
            width: 100%;
            max-width: 1280px;
            padding: 0 1rem;
        }

        .carousel-container {
            position: relative;
            overflow: hidden;
            padding: 0 12.5%;
            /* Ajoute un espace sur les côtés pour voir les slides adjacentes */
        }

        .carousel-slides {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        }

        .carousel-slide {
            padding: 0 10px;
            transition: all 0.5s ease;
        }

        .active-slide {
            z-index: 10;
        }

        /* Pour les appareils mobiles */
        @media (max-width: 767px) {
            .carousel-container {
                padding: 0;
                /* Pas d'espace sur mobile car une seule slide est visible */
            }
        }
    </style>
</head>

<body class="h-full flex flex-col bg-gray-50 min-h-screen">
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

                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-gray-700 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </button>
                </div>

                <div class="hidden md:flex md:items-center">
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

        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-lg py-2 px-4">
            <a href="?view=events" class="block py-2 text-gray-800 hover:text-gray-900">Liste événements</a>
            <?php if ($adminController->isAdmin()): ?>
                <a href="?view=create" class="block py-2 text-gray-800 hover:text-gray-900">Créer un événement</a>
                <a href="?view=userList" class="block py-2 text-gray-800 hover:text-gray-900">User List</a>
            <?php endif; ?>

            <div class="border-t border-gray-200 my-2 pt-2">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="flex items-center py-2">
                        <span class="text-gray-800 mr-2"><?= htmlspecialchars($_SESSION['user']['nom']) ?></span>
                        <?php if ($adminController->isAdmin()): ?>
                            <img src="/project_event_manager_blog/public/image/crown.png" alt="Admin Icon">
                        <?php endif; ?>
                    </div>
                    <a href="?view=logout" class="block py-2 text-red-600 hover:text-red-800">Déconnexion</a>
                <?php else: ?>
                    <a href="?view=login" class="block py-2 text-gray-600 hover:text-gray-900">Connexion</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>