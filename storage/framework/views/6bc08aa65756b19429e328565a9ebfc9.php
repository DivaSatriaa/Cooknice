<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <title>Halaman Profile</title>
        <link rel="stylesheet" href="<?php echo e(asset('build/assets/app-CMmxYR91.css')); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <link rel="icon" href="<?php echo e(asset('gambar/fixlogo.png')); ?>" type="image/png">
        <style>
            .main-container { position: relative; z-index: 10; }
            .grid { position: relative; z-index: 20; }
            .hidden { display: none !important; }
        </style>
    </head>

    <body class="bg-[#F9E2AF]">
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

            <div class="bg-[#FFFFFF] text-4xl text-center w-[1430px] flex-1 rounded-md m-2 ml-1 border border-[#000000] overflow-y-auto main-container">
                <!-- header -->
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

                <!-- Profil Pengguna -->
                <section class="flex items-center space-x-10 w-[670px] mx-auto py-10">
                    <div class="w-[100px] h-[100px] rounded-full overflow-hidden border border-[#000000]">
                        <img src="<?php echo e(Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('gambar/profile.png')); ?>" alt="Foto Profil" class="w-full h-full object-cover">
                    </div>
                    <div class="text-left">
                        <h1 class="text-1xl font-semibold text-[#333]">
                            <?php echo e(Auth::user()->name ?? 'Guest User'); ?>

                        </h1>
                    </div>
                </section>

                <!-- Deskripsi User -->
                <section class="text-center px-8">
                    <p class="text-base text-gray-700 mb-4 max-w-2xl mx-auto text-justify">
                        <?php echo e(Auth::user()->profile_description ?? 'Belum ada deskripsi.'); ?>

                    </p>
                </section>

                <!-- Tombol Edit Profil -->
                <div class="max-w-[750px] mx-auto text-center flex items-center justify-center px-10 mt-6">
                    <a href="/editprofile" class="bg-[#FFFFFF] text-[#000000] px-5 py-2 rounded-xl border border-[#000000] hover:bg-[#FFFFFF] text-sm font-medium w-full">
                        Edit Profil
                    </a>
                </div>

                <div class="grid grid-cols-4 gap-6 p-4 mx-auto text-left mt-10">
                    <?php if($recipes->isEmpty()): ?>
                        <div class="flex flex-col col-span-4 items-center gap-4">
                            <img src="/gambar/lightbulb.png" class="w-20 h-20">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Belum ada resep</h2>
                            <p class="text-gray-600 text-3xl">Unggah resep yang ingin anda bagikan</p>
                        </div>
                    <?php else: ?>
                        <?php $__currentLoopData = $recipes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if (isset($component)) { $__componentOriginale43b550a14883d0248293fe4806b335a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale43b550a14883d0248293fe4806b335a = $attributes; } ?>
<?php $component = App\View\Components\CardResep::resolve(['recipe' => $recipe] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card-resep'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\CardResep::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale43b550a14883d0248293fe4806b335a)): ?>
<?php $attributes = $__attributesOriginale43b550a14883d0248293fe4806b335a; ?>
<?php unset($__attributesOriginale43b550a14883d0248293fe4806b335a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale43b550a14883d0248293fe4806b335a)): ?>
<?php $component = $__componentOriginale43b550a14883d0248293fe4806b335a; ?>
<?php unset($__componentOriginale43b550a14883d0248293fe4806b335a); ?>
<?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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

        <script>
            // Hapus event listener sebelumnya
            document.removeEventListener('click', closePopups);
            document.addEventListener('click', closePopups);

            function togglePopup(event, popupId, button) {
                event.preventDefault();
                event.stopPropagation();
                console.log('Toggling popup: ' + popupId);
                const popup = document.getElementById(popupId);
                if (popup) {
                    const rect = button.getBoundingClientRect();
                    // Posisi popup di atas tombol, dengan offset
                    popup.style.top = (rect.top + window.scrollY - 10) + 'px'; // Asumsi tinggi popup ~100px + offset
                    popup.style.left = (rect.right + window.scrollX - 178) + 'px'; // Sedikit ke kiri dari kanan tombol
                    popup.classList.toggle('hidden');
                    console.log('Popup visibility: ' + (popup.classList.contains('hidden') ? 'hidden' : 'visible'));
                    console.log('Popup position: top=' + popup.style.top + ', left=' + popup.style.left);
                    // Cek sidebar span
                    document.querySelectorAll('aside span.sidebar-label').forEach(span => {
                        console.log('Sidebar span class: ' + span.className);
                        if (span.classList.contains('hidden') && window.innerWidth >= 640) {
                            console.warn('Sidebar span unexpectedly hidden on sm+ screen');
                        }
                    });
                } else {
                    console.error('Popup not found: ' + popupId);
                }
                // Tutup popup lain
                document.querySelectorAll('[id^="popup-"]').forEach(otherPopup => {
                    if (otherPopup.id !== popupId) {
                        otherPopup.classList.add('hidden');
                    }
                });
            }

            function closePopups(event) {
                const popups = document.querySelectorAll('[id^="popup-"]');
                const buttons = document.querySelectorAll('.edit-button');
                let isClickInside = false;

                popups.forEach(popup => {
                    if (popup.contains(event.target)) {
                        isClickInside = true;
                    }
                });
                buttons.forEach(button => {
                    if (button.contains(event.target)) {
                        isClickInside = true;
                    }
                });

                if (!isClickInside) {
                    console.log('Closing all popups');
                    popups.forEach(popup => {
                        popup.classList.add('hidden');
                    });
                    // Cek sidebar span setelah menutup popup
                    document.querySelectorAll('aside span.sidebar-label').forEach(span => {
                        console.log('After close - Sidebar span class: ' + span.className);
                        if (span.classList.contains('hidden') && window.innerWidth >= 640) {
                            console.warn('Sidebar span hidden after closePopups on sm+ screen');
                            span.classList.remove('hidden');
                        }
                    });
                }
            }
        </script>
    </body>
</html><?php /**PATH C:\Users\ASUS\Cooknice2\resources\views/halamanprofile.blade.php ENDPATH**/ ?>