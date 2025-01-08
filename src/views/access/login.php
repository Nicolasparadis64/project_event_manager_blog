    <div class="flex items-center justify-center">
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
            <a href="?view=register" class="text-gray-600 hover:text-gray-900">Inscription</a>
        </div>
    </div>