<div class="bg-white rounded-xl shadow-md overflow-hidden relative">
    <a href="<?php echo e(route('recipe.show', $recipe->id)); ?>" class="block" onclick="console.log('Card clicked: <?php echo e($recipe->id); ?>')">
        <?php if($recipe->main_image): ?>
            <img src="<?php echo e(asset('storage/' . $recipe->main_image)); ?>" alt="Menu" class="w-full h-40 object-cover">
        <?php else: ?>
            <img src="https://placehold.co/400x200/cccccc/333333?text=No+Image" alt="No Image" class="w-full h-40 object-cover">
        <?php endif; ?>
        <div class="p-4 flex justify-between items-center">
            <div>
                <h2 class="font-bold text-lg">
                    <?php echo e($recipe->title); ?>

                </h2>
                <p class="text-sm text-gray-600">
                    <?php echo e($recipe->user->name ?? 'Unknown User'); ?>

                </p>
            </div>
            <div class="flex items-center">
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Route::currentRouteName() == 'profile.show' && Auth::id() == $recipe->user_id): ?>
                        <!-- Ikon tiga titik untuk popup di halamanprofile -->
                        <button type="button" class="edit-button inline-flex p-1 z-50" onclick="togglePopup(event, 'popup-<?php echo e($recipe->id); ?>', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </button>
                    <?php else: ?>
                        <!-- Ikon bookmark untuk favorit -->
                        <form action="<?php echo e(route('favorites.toggle', $recipe->id)); ?>" method="POST" class="favorite-form inline-flex items-center">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="favorite-button inline-flex p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="<?php echo e($recipe->favorites()->where('user_id', Auth::id())->exists() ? 'black' : 'none'); ?>" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                            </button>
                        </form>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="favorite-button inline-flex p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </a>
    <!-- Popup di luar elemen <a> -->
    <?php if(auth()->guard()->check()): ?>
        <?php if(Route::currentRouteName() == 'profile.show' && Auth::id() == $recipe->user_id): ?>
            <div id="popup-<?php echo e($recipe->id); ?>" class="hidden fixed bg-white border border-gray-300 rounded-lg shadow-lg p-2 z-[1000] min-w-[150px]" onclick="event.stopPropagation()">
                <a href="<?php echo e(route('recipe.edit', $recipe->id)); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.stopPropagation()">Edit Resep</a>
                <form action="<?php echo e(route('recipe.destroy', $recipe->id)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onclick="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus resep ini?')">Hapus Resep</button>
                </form>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>

<style>
    .hidden { display: none !important; }
    .edit-button { z-index: 50; }
    [id^="popup-"] {
        z-index: 1000;
        min-width: 150px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style><?php /**PATH C:\Users\ASUS\Cooknice2\resources\views/components/card-resep.blade.php ENDPATH**/ ?>