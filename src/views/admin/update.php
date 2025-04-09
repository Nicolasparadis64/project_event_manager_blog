<div class="container mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <h1 class="text-2xl font-bold text-gray-900 mb-6">Modifier l'événement</h1>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6 mb-6">
            <form action="?view=update_event" method="POST" enctype="multipart/form-data" class="space-y-4">
                <input type="hidden" name="id" value="<?= $event['id_evenement'] ?>">

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                    <input type="text" name="title" id="title" value="<?= htmlspecialchars($event['titre']) ?>" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3" required
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"><?= htmlspecialchars($event['description']) ?></textarea>
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                        <input type="date" name="date" id="date" value="<?= htmlspecialchars($event['date']) ?>" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>

                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700">Heure</label>
                        <input type="time" name="time" id="time" value="<?= htmlspecialchars($event['heure']) ?>" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    </div>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700">Lieu</label>
                    <input type="text" name="location" id="location" value="<?= htmlspecialchars($event['lieu']) ?>" required
                        class="mt-1 mb-6 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                    <?php if (!empty($event['image_path'])): ?>
                        <div class="mt-2 mb-3">
                            <img src="<?= htmlspecialchars($event['image_path']) ?>" alt="<?= htmlspecialchars($event['titre']) ?>"
                                class="h-32 w-auto object-cover rounded-md">
                            <p class="mt-1 text-sm text-gray-500">Image actuelle</p>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="image" id="image" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500
                      file:mr-4 file:py-2 file:px-4
                      file:rounded-md file:border-0
                      file:text-sm file:font-semibold
                      file:bg-gray-50 file:text-gray-700
                      hover:file:bg-gray-100">
                    <p class="mt-1 text-sm text-gray-500">JPG, PNG ou GIF (max. 5MB). Laissez vide pour conserver l'image actuelle.</p>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="justify-center border border-transparent inline shadow-sm text-sm font-medium text-white bg-gray-800 hover:bg-gray-900 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 px-4 py-2 rounded">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>