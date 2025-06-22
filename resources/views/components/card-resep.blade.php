<div class="bg-white rounded-xl shadow-md overflow-hidden relative">
    <a href="{{ route('recipe.show', $recipe->id) }}" class="block" onclick="console.log('Card clicked: {{ $recipe->id }}')">
        @if($recipe->main_image)
            <img src="{{ asset('storage/' . $recipe->main_image) }}" alt="Menu" class="w-full h-40 object-cover">
        @else
            <img src="https://placehold.co/400x200/cccccc/333333?text=No+Image" alt="No Image" class="w-full h-40 object-cover">
        @endif
        <div class="p-4 flex justify-between items-center">
            <div>
                <h2 class="font-bold text-lg">
                    {{ $recipe->title }}
                </h2>
                <p class="text-sm text-gray-600">
                    {{ $recipe->user->name ?? 'Unknown User' }}
                </p>
            </div>
            <div class="flex items-center">
                @auth
                    @if(Route::currentRouteName() == 'profile.show' && Auth::id() == $recipe->user_id)
                        <!-- Ikon tiga titik untuk popup di halamanprofile -->
                        <button type="button" class="edit-button inline-flex p-1 z-50" onclick="togglePopup(event, 'popup-{{ $recipe->id }}', this)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                            </svg>
                        </button>
                    @else
                        <!-- Ikon bookmark untuk favorit -->
                        <form action="{{ route('favorites.toggle', $recipe->id) }}" method="POST" class="favorite-form inline-flex items-center">
                            @csrf
                            <button type="submit" class="favorite-button inline-flex p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $recipe->favorites()->where('user_id', Auth::id())->exists() ? 'black' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="favorite-button inline-flex p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                        </svg>
                    </a>
                @endauth
            </div>
        </div>
    </a>
    <!-- Popup di luar elemen <a> -->
    @auth
        @if(Route::currentRouteName() == 'profile.show' && Auth::id() == $recipe->user_id)
            <div id="popup-{{ $recipe->id }}" class="hidden fixed bg-white border border-gray-300 rounded-lg shadow-lg p-2 z-[1000] min-w-[150px]" onclick="event.stopPropagation()">
                <a href="{{ route('recipe.edit', $recipe->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" onclick="event.stopPropagation()">Edit Resep</a>
                <form action="{{ route('recipe.destroy', $recipe->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onclick="event.stopPropagation(); return confirm('Apakah Anda yakin ingin menghapus resep ini?')">Hapus Resep</button>
                </form>
            </div>
        @endif
    @endauth
</div>

<style>
    .hidden { display: none !important; }
    .edit-button { z-index: 50; }
    [id^="popup-"] {
        z-index: 1000;
        min-width: 150px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
</style>