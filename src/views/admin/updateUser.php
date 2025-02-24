<div class="flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-6">Modifier l'utilisateur</h1>
        
        <form action="?view=updateUser&id=<?= $_GET['id'] ?>" method="POST" class="space-y-4">
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
                <select name="role" id="role" class="block w-full mt-1 p-2 border rounded">
                    <option value="user" <?= ($user['role'] ?? '') === 'user' ? 'selected' : '' ?>>Utilisateur</option>
                    <option value="admin" <?= ($user['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            
            <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Mettre à jour
            </button>
        </form>
        
        <a href="?view=userList" class="mt-4 inline-block text-gray-600 hover:text-gray-900">
            Retour à la liste
        </a>
    </div>
</div>