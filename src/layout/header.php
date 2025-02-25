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
<nav id="navbar" class="fixed top-0 w-full backdrop-blur-lg bg-white/90 shadow-lg z-10" style="transition: transform 0.3s ease, opacity 0.3s ease">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="?view=home" class="flex items-center text-xl font-bold text-gray-800">
                        EventManager
                    </a>
                    <div class="hidden md:flex md:items-center md:ml-6 space-x-4">
                        <a href="?view=events" class="text-gray-800 hover:text-gray-900 px-3 py-2 rounded-md">Événements</a>
                        <?php if ($adminController->isAdmin()): ?>
                            <td class="py-3 px-6 text-left">
                                <a href="?view=create" class="text-gray-800 hover:text-gray-900 px-3 py-2 rounded-md">Créer</a>
                            </td>
                            <td class='py-3 px-6 text-left'>
                                <a href="?view=userList" class='text-gray-800 hover:text-gray-900 px-3 py-2 rounded-md'>User List</a>
                            </td>
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