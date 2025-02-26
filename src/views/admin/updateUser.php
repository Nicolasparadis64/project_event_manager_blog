<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold mb-6">Modifier l'utilisateur</h1>
    <div class="bg-white shadow rounded-lg overflow-hidden">

    <div class="px-6 py-6 mb-12">
        <form action="?view=updateUser&id=<?= $_GET['id'] ?>" method="POST" class="space-y-4 ">
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" value="<?= htmlspecialchars($user['nom'] ?? '') ?>" required 
                       class="block w-full mt-1 p-2 border rounded">
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required 
                       class="block w-full mt-1 p-2 border rounded">
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
                <select name="role" id="role" class="block w-full mt-1 p-2 border rounded mb-6">
                    <option value="user" <?= ($user['role'] ?? '') === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                    <option value="admin" <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            
            <button type="submit" class="justify-center border border-transparent inline shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 rounded">
                Mettre à jour
            </button>
        </form>
        
        <a href="?view=userList" class="mt-4 inline-block text-gray-600 hover:text-gray-900">
            Retour à la liste
        </a>
        </div>
    </div>
</div>