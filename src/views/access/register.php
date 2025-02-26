
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

<div class="flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-96">
            <h1 class="text-2xl font-bold mb-6">Inscription</h1>


            </form>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form action="?view=register" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nom">
                        Nom
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="nom" type="text" name="nom" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="prenom">
                        Prénom
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="prenom" type="text" name="prenom" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="email" id="email" name="email" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mot_de_passe">
                        Mot de passe
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="mot_de_passe" type="password" name="mot_de_passe" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="confirmation_mot_de_passe">
                        Confirmer le mot de passe
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="confirmation_mot_de_passe" type="password" name="confirmation_mot_de_passe" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="justify-center border border-transparent inline shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 rounded"
                        type="submit">
                        S'inscrire
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-gray-700 hover:text-gray-900"
                        href="?view=login">
                        Déjà inscrit ?
                    </a>
                </div>
            </form>
        </div>
    </div>

    </div>