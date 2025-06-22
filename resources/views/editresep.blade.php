@extends('layouts.app')

@section('title', 'Edit Resep')

@section('content')
<div class="flex h-screen overflow-hidden">
    <x-sidebar></x-sidebar>
    <div class="bg-[#FFFFFF] text-4xl w-[1250px] flex-1 rounded-md m-2 ml-1 border overflow-y-auto">
        <x-header></x-header>
        <div class="bg-white rounded-lg p-6 w-full h-full">
            <div class="bg-white rounded-lg w-full h-full p-6">
                <h2 class="text-2xl font-semibold mb-4">Edit Resep</h2>

                @if (session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('recipe.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" class="md:flex md:space-x-6">
                    @csrf
                    @method('PATCH')

                    <!-- Bagian kiri: Foto dan bahan -->
                    <div class="w-full md:w-1/3">
                        <!-- Kotak Upload Gambar -->
                        <div
                            id="drop-area"
                            class="border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center p-4 cursor-pointer transition hover:bg-gray-50"
                            style="aspect-ratio: 1/1;"
                            onclick="document.getElementById('foto').click()"
                            ondragover="event.preventDefault()"
                            ondrop="handleDrop(event)"
                        >
                            <img id="preview" src="{{ $recipe->main_image ? asset('storage/' . $recipe->main_image) : asset('images/camera.png') }}" alt="Preview" class="{{ $recipe->main_image ? 'object-cover w-full h-full rounded-lg' : 'w-12 h-12 mb-2' }}">
                            <p class="font-semibold text-gray-700/70">Foto Resep</p>
                            <p class="text-sm text-gray-500 text-center">Klik atau tarik file ke sini</p>
                        </div>
                        <input type="file" name="foto" id="foto" class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="handleFile(this.files)">
                        @error('foto')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror

                        <!-- Bahan -->
                        <div class="mt-6">
                            <label class="block font-medium text-xl mb-2">Bahan</label>
                            <div id="bahan-container" class="space-y-2 text-xl">
                                @foreach ($recipe->ingredients ?? [] as $index => $bahan)
                                    <input type="text" name="bahan[]" value="{{ $bahan }}" class="border p-2 rounded w-full" required>
                                @endforeach
                            </div>
                            @error('bahan.*')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                            <button type="button" onclick="tambahBahan()" class="mt-2 text-[#F58E4A] hover:underline text-sm cursor-pointer">
                                + Bahan
                            </button>
                        </div>
                    </div>

                    <!-- Bagian kanan: Form -->
                    <div class="w-full md:w-2/3 space-y-6 mt-6 md:mt-0">
                        <div>
                            <label class="block font-medium text-xl">Judul Resep</label>
                            <input type="text" name="title" value="{{ old('title', $recipe->title) }}" class="border p-2 rounded w-full text-xl" required>
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-xl">Kategori</label>
                            <select name="category_id" class="border p-2 rounded w-full text-xl text-gray-700/70" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $recipe->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-xl">Deskripsi</label>
                            <textarea name="description" rows="5" class="border p-2 rounded w-full text-xl">{{ old('description', $recipe->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-xl">Porsi</label>
                            <input type="text" name="porsi" value="{{ old('porsi', $recipe->servings) }}" class="border p-2 rounded w-full text-xl">
                            @error('porsi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>   
                            <label class="block font-medium text-xl">Durasi</label>
                            <input type="text" name="durasi" value="{{ old('durasi', $recipe->duration) }}" class="border p-2 rounded w-full text-xl">
                            @error('durasi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-xl mb-1">Langkah-langkah Memasak</label>
                            <div id="langkah-container" class="space-y-4">
                                @foreach ($recipe->steps ?? [] as $index => $langkah)
                                    <div class="flex items-start space-x-3">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#F58E4A] text-white font-bold text-xl mt-1">
                                            {{ $index + 1 }}
                                        </div>
                                        <div class="flex-1 space-y-2">
                                            <textarea name="langkah[]" rows="3" class="border p-2 rounded w-full text-xl" required>{{ $langkah }}</textarea>
                                            <div
                                                class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer hover:bg-gray-50"
                                                style="width: 80px; height: 80px;"
                                                onclick="this.nextElementSibling.click()"
                                            >
                                                <img src="{{ isset($recipe->step_images[$index]) ? asset('storage/' . $recipe->step_images[$index]) : asset('images/camera.png') }}" alt="Preview" class="w-6 h-6 {{ isset($recipe->step_images[$index]) ? 'object-cover w-full h-full' : '' }}">
                                            </div>
                                            <input type="file" name="foto_langkah[]" class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewStepImage(this)">
                                            @error('foto_langkah.' . $index)
                                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @error('langkah.*')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                            <button type="button" onclick="tambahLangkah()" class="mt-3 text-[#F58E4A] cursor-pointer hover:underline text-sm">
                                + Tambah Langkah
                            </button>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-[#F58E4A] text-white px-10 py-4 rounded-md hover:bg-[#f56c4a] cursor-pointer text-xl">
                                Perbarui
                            </button>
                            <a href="{{ route('profile.show') }}" class="bg-gray-300 text-gray-700 px-10 py-4 rounded-md hover:bg-gray-400 cursor-pointer text-xl">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-clicked-profile></x-clicked-profile>
</div>

<script>
function tambahBahan() {
    const container = document.getElementById('bahan-container');
    const input = document.createElement('input');
    input.type = 'text';
    input.name = 'bahan[]';
    input.className = 'border p-2 rounded w-full';
    input.required = true;
    container.appendChild(input);
}

function handleFile(files) {
    const file = files[0];
    if (!file) return;

    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB

    if (!validTypes.includes(file.type)) {
        alert('Format gambar harus JPEG, PNG, JPG, atau GIF.');
        document.getElementById('foto').value = '';
        document.getElementById('preview').src = "{{ asset('images/camera.png') }}";
        return;
    }

    if (file.size > maxSize) {
        alert('Ukuran gambar tidak boleh lebih dari 2MB.');
        document.getElementById('foto').value = '';
        document.getElementById('preview').src = "{{ asset('images/camera.png') }}";
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        const preview = document.getElementById('preview');
        preview.src = e.target.result;
        preview.classList.add('object-cover', 'w-full', 'h-full', 'rounded-lg');
        preview.classList.remove('w-12', 'h-12', 'mb-2');
    };
    reader.readAsDataURL(file);
}

function handleDrop(e) {
    e.preventDefault();
    const files = e.dataTransfer.files;
    document.getElementById('foto').files = files;
    handleFile(files);
}

function previewStepImage(input) {
    const file = input.files[0];
    if (!file) return;

    const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    const maxSize = 2 * 1024 * 1024; // 2MB

    if (!validTypes.includes(file.type)) {
        alert('Format gambar langkah harus JPEG, PNG, JPG, atau GIF.');
        input.value = '';
        input.previousElementSibling.querySelector('img').src = "{{ asset('images/camera.png') }}";
        return;
    }

    if (file.size > maxSize) {
        alert('Ukuran gambar langkah tidak boleh lebih dari 2MB.');
        input.value = '';
        input.previousElementSibling.querySelector('img').src = "{{ asset('images/camera.png') }}";
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        input.previousElementSibling.querySelector('img').src = e.target.result;
        input.previousElementSibling.querySelector('img').classList.add('object-cover', 'w-full', 'h-full');
    };
    reader.readAsDataURL(file);
}

let langkahCounter = {{ count($recipe->steps ?? []) + 1 }};

function tambahLangkah() {
    const container = document.getElementById('langkah-container');
    const wrapper = document.createElement('div');
    wrapper.className = 'flex items-start space-x-3';

    const circle = document.createElement('div');
    circle.className = 'flex items-center justify-center w-8 h-8 rounded-full bg-[#F58E4A] text-white font-bold text-xl mt-1';
    circle.textContent = langkahCounter;

    const content = document.createElement('div');
    content.className = 'flex-1 space-y-2';
    content.innerHTML = `
        <textarea name="langkah[]" rows="3" class="border p-2 rounded w-full text-xl" required></textarea>
        <div
            class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer hover:bg-gray-50"
            style="width: 80px; height: 80px;"
            onclick="this.nextElementSibling.click()"
        >
            <img src="{{ asset('images/camera.png') }}" alt="Preview" class="w-6 h-6">
        </div>
        <input type="file" name="foto_langkah[]" class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewStepImage(this)">
    `;

    wrapper.appendChild(circle);
    wrapper.appendChild(content);
    container.appendChild(wrapper);

    langkahCounter++;
}
</script>
@endsection