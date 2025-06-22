

<?php $__env->startSection('title', 'Edit Resep'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex h-screen overflow-hidden">
    <?php if (isset($component)) { $__componentOriginald31f0a1d6e85408eecaaa9471b609820 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald31f0a1d6e85408eecaaa9471b609820 = $attributes; } ?>
<?php $component = App\View\Components\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Sidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald31f0a1d6e85408eecaaa9471b609820)): ?>
<?php $attributes = $__attributesOriginald31f0a1d6e85408eecaaa9471b609820; ?>
<?php unset($__attributesOriginald31f0a1d6e85408eecaaa9471b609820); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald31f0a1d6e85408eecaaa9471b609820)): ?>
<?php $component = $__componentOriginald31f0a1d6e85408eecaaa9471b609820; ?>
<?php unset($__componentOriginald31f0a1d6e85408eecaaa9471b609820); ?>
<?php endif; ?>
    <div class="bg-[#FFFFFF] text-4xl w-[1250px] flex-1 rounded-md m-2 ml-1 border overflow-y-auto">
        <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
        <div class="bg-white rounded-lg p-6 w-full h-full">
            <div class="bg-white rounded-lg w-full h-full p-6">
                <h2 class="text-2xl font-semibold mb-4">Edit Resep</h2>

                <?php if(session('success')): ?>
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>
                <?php if($errors->any()): ?>
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('recipe.update', $recipe->id)); ?>" method="POST" enctype="multipart/form-data" class="md:flex md:space-x-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

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
                            <img id="preview" src="<?php echo e($recipe->main_image ? asset('storage/' . $recipe->main_image) : asset('images/camera.png')); ?>" alt="Preview" class="<?php echo e($recipe->main_image ? 'object-cover w-full h-full rounded-lg' : 'w-12 h-12 mb-2'); ?>">
                            <p class="font-semibold text-gray-700/70">Foto Resep</p>
                            <p class="text-sm text-gray-500 text-center">Klik atau tarik file ke sini</p>
                        </div>
                        <input type="file" name="foto" id="foto" class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="handleFile(this.files)">
                        <?php $__errorArgs = ['foto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                        <!-- Bahan -->
                        <div class="mt-6">
                            <label class="block font-medium text-xl mb-2">Bahan</label>
                            <div id="bahan-container" class="space-y-2 text-xl">
                                <?php $__currentLoopData = $recipe->ingredients ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <input type="text" name="bahan[]" value="<?php echo e($bahan); ?>" class="border p-2 rounded w-full" required>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['bahan.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <button type="button" onclick="tambahBahan()" class="mt-2 text-[#F58E4A] hover:underline text-sm cursor-pointer">
                                + Bahan
                            </button>
                        </div>
                    </div>

                    <!-- Bagian kanan: Form -->
                    <div class="w-full md:w-2/3 space-y-6 mt-6 md:mt-0">
                        <div>
                            <label class="block font-medium text-xl">Judul Resep</label>
                            <input type="text" name="title" value="<?php echo e(old('title', $recipe->title)); ?>" class="border p-2 rounded w-full text-xl" required>
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block font-medium text-xl">Kategori</label>
                            <select name="category_id" class="border p-2 rounded w-full text-xl text-gray-700/70" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $recipe->category_id) == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block font-medium text-xl">Deskripsi</label>
                            <textarea name="description" rows="5" class="border p-2 rounded w-full text-xl"><?php echo e(old('description', $recipe->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block font-medium text-xl">Porsi</label>
                            <input type="text" name="porsi" value="<?php echo e(old('porsi', $recipe->servings)); ?>" class="border p-2 rounded w-full text-xl">
                            <?php $__errorArgs = ['porsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>   
                            <label class="block font-medium text-xl">Durasi</label>
                            <input type="text" name="durasi" value="<?php echo e(old('durasi', $recipe->duration)); ?>" class="border p-2 rounded w-full text-xl">
                            <?php $__errorArgs = ['durasi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div>
                            <label class="block font-medium text-xl mb-1">Langkah-langkah Memasak</label>
                            <div id="langkah-container" class="space-y-4">
                                <?php $__currentLoopData = $recipe->steps ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $langkah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex items-start space-x-3">
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-[#F58E4A] text-white font-bold text-xl mt-1">
                                            <?php echo e($index + 1); ?>

                                        </div>
                                        <div class="flex-1 space-y-2">
                                            <textarea name="langkah[]" rows="3" class="border p-2 rounded w-full text-xl" required><?php echo e($langkah); ?></textarea>
                                            <div
                                                class="border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center cursor-pointer hover:bg-gray-50"
                                                style="width: 80px; height: 80px;"
                                                onclick="this.nextElementSibling.click()"
                                            >
                                                <img src="<?php echo e(isset($recipe->step_images[$index]) ? asset('storage/' . $recipe->step_images[$index]) : asset('images/camera.png')); ?>" alt="Preview" class="w-6 h-6 <?php echo e(isset($recipe->step_images[$index]) ? 'object-cover w-full h-full' : ''); ?>">
                                            </div>
                                            <input type="file" name="foto_langkah[]" class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewStepImage(this)">
                                            <?php $__errorArgs = ['foto_langkah.' . $index];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <?php $__errorArgs = ['langkah.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-500 text-sm mt-2"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <button type="button" onclick="tambahLangkah()" class="mt-3 text-[#F58E4A] cursor-pointer hover:underline text-sm">
                                + Tambah Langkah
                            </button>
                        </div>

                        <div class="flex space-x-4">
                            <button type="submit" class="bg-[#F58E4A] text-white px-10 py-4 rounded-md hover:bg-[#f56c4a] cursor-pointer text-xl">
                                Perbarui
                            </button>
                            <a href="<?php echo e(route('profile.show')); ?>" class="bg-gray-300 text-gray-700 px-10 py-4 rounded-md hover:bg-gray-400 cursor-pointer text-xl">
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalee101339da4a776c518469591417bd80 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalee101339da4a776c518469591417bd80 = $attributes; } ?>
<?php $component = App\View\Components\ClickedProfile::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('clicked-profile'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ClickedProfile::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalee101339da4a776c518469591417bd80)): ?>
<?php $attributes = $__attributesOriginalee101339da4a776c518469591417bd80; ?>
<?php unset($__attributesOriginalee101339da4a776c518469591417bd80); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalee101339da4a776c518469591417bd80)): ?>
<?php $component = $__componentOriginalee101339da4a776c518469591417bd80; ?>
<?php unset($__componentOriginalee101339da4a776c518469591417bd80); ?>
<?php endif; ?>
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
        document.getElementById('preview').src = "<?php echo e(asset('images/camera.png')); ?>";
        return;
    }

    if (file.size > maxSize) {
        alert('Ukuran gambar tidak boleh lebih dari 2MB.');
        document.getElementById('foto').value = '';
        document.getElementById('preview').src = "<?php echo e(asset('images/camera.png')); ?>";
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
        input.previousElementSibling.querySelector('img').src = "<?php echo e(asset('images/camera.png')); ?>";
        return;
    }

    if (file.size > maxSize) {
        alert('Ukuran gambar langkah tidak boleh lebih dari 2MB.');
        input.value = '';
        input.previousElementSibling.querySelector('img').src = "<?php echo e(asset('images/camera.png')); ?>";
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        input.previousElementSibling.querySelector('img').src = e.target.result;
        input.previousElementSibling.querySelector('img').classList.add('object-cover', 'w-full', 'h-full');
    };
    reader.readAsDataURL(file);
}

let langkahCounter = <?php echo e(count($recipe->steps ?? []) + 1); ?>;

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
            <img src="<?php echo e(asset('images/camera.png')); ?>" alt="Preview" class="w-6 h-6">
        </div>
        <input type="file" name="foto_langkah[]" class="hidden" accept="image/jpeg,image/png,image/jpg,image/gif" onchange="previewStepImage(this)">
    `;

    wrapper.appendChild(circle);
    wrapper.appendChild(content);
    container.appendChild(wrapper);

    langkahCounter++;
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ASUS\Cooknice2\resources\views/editresep.blade.php ENDPATH**/ ?>