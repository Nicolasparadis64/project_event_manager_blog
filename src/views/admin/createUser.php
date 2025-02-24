<h1 class="text-xl font-bold mb-4">Créer un utilisateur</h1>

<form action="?view=createUser" method="POST" class="space-y-4">
    <div>
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
        <input type="text" name="nom" id="nom" required class="block w-full mt-1 p-2 border rounded">
    </div>
    <div>
    <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
    <input type="text" name="prenom" id="prenom" required class="block w-full mt-1 p-2 border rounded">
    </div>
    <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" name="email" id="email" required class="block w-full mt-1 p-2 border rounded">
    </div>
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" name="password" id="password" required class="block w-full mt-1 p-2 border rounded">
    </div>
    <div>
        <label for="role" class="block text-sm font-medium text-gray-700">Rôle</label>
        <select name="role" id="role" class="block w-full mt-1 p-2 border rounded">
            <option value="user">Utilisateur</option>
            <option value="admin">Admin</option>
        </select>
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Créer</button>
</form>
