<aside class="bg-white flex-shrink-0 rounded-md m-2 mr-1 border shadow-lg transition-all duration-300 md:w-64 sm:w-20 flex flex-col items-center py-6">
    <!-- Logo -->
    <div class="w-full h-20 mb-10 mt-2 items-center flex justify-center">
        <img src="<?php echo e(asset('gambar/fixlogo.png')); ?>" alt="logo" class="w-15 rounded-full bg-[#F9E2AF] object-cover">
        <img src="<?php echo e(asset('gambar/fixtextlogo.png')); ?>" alt="logo" class="w-35 mt-3 object-cover">
    </div>

    <!-- Menu Items -->
    <nav class="flex flex-col space-y-4 w-full px-4">
        <!-- Item -->
        <a href="<?php echo e(route('beranda.setelah.login')); ?>" class="<?php echo e(request()->is('berandaSetelahLogin', '/') ? 'bg-[#F58E4A] text-white hover:text-black' : 'text-black rounded-xl hover:bg-[#D9D9D9]'); ?> flex items-center space-x-4 px-4 py-3 rounded-xl hover:bg-[#D9D9D9] transition-all duration-300">
            <div class="bg-white p-2 rounded-full">
                <img src="<?php echo e(asset('gambar/home.png')); ?>" alt="beranda" class="w-6 h-6" />
            </div>
            <span class="text-lg font-semibold sidebar-label hidden sm:inline">
                Beranda
            </span>
        </a>

        <a href="<?php echo e(route('makanan')); ?>" class="<?php echo e(request()->is('makanan') ? 'bg-[#F58E4A] text-white hover:text-black' : 'text-black rounded-xl hover:bg-[#D9D9D9]'); ?> flex items-center space-x-4 px-4 py-3 rounded-xl hover:bg-[#D9D9D9] transition-all duration-300">
            <div class="bg-white p-2 rounded-full">
                <img src="<?php echo e(asset('gambar/dish (1).png')); ?>" alt="makanan" class="w-6 h-6" />
            </div>
            <span class="text-lg font-semibold sidebar-label hidden sm:inline">
                Makanan
            </span>
        </a>

        <a href="/minuman" class="<?php echo e(request()->is('minuman') ? 'bg-[#F58E4A] text-white hover:text-black' : 'text-black rounded-xl hover:bg-[#D9D9D9]'); ?> flex items-center space-x-4 px-4 py-3 rounded-xl hover:bg-[#D9D9D9] transition-all duration-300">
            <div class="bg-white p-2 rounded-full">
                <img src="<?php echo e(asset('gambar/soda.png')); ?>" alt="minuman" class="w-6 h-6" />
            </div>
            <span class="text-lg font-semibold sidebar-label hidden sm:inline">
                Minuman
            </span>
        </a>

        <a href="/cemilan" class="<?php echo e(request()->is('cemilan') ? 'bg-[#F58E4A] text-white hover:text-black' : 'text-black rounded-xl hover:bg-[#D9D9D9]'); ?> flex items-center space-x-4 px-4 py-3 rounded-xl hover:bg-[#D9D9D9] transition-all duration-300">
            <div class="bg-white p-2 rounded-full">
                <img src="<?php echo e(asset('gambar/nuggets.png')); ?>" alt="cemilan" class="w-6 h-6" />
            </div>
            <span class="text-lg font-semibold sidebar-label hidden sm:inline">
                Cemilan
            </span>
        </a>

        <a href="<?php echo e(route('koleksiAda')); ?>" class="<?php echo e(request()->is('koleksiAda') ? 'bg-[#F58E4A] text-white hover:text-black' : 'text-black rounded-xl hover:bg-[#D9D9D9]'); ?> flex items-center space-x-4 px-4 py-3 rounded-xl hover:bg-[#D9D9D9] transition-all duration-300">
            <div class="bg-white p-2 rounded-full">
                <img src="<?php echo e(asset('gambar/bookmark.png')); ?>" alt="koleksi" class="w-6 h-6" />
            </div>
            <span class="text-lg font-semibold sidebar-label hidden sm:inline">
                Koleksi
            </span>
        </a>
    </nav>
</aside>

<style>
    .sidebar-label.sm\:inline {
        display: inline !important;
    }
</style><?php /**PATH C:\Users\ASUS\Cooknice2\resources\views/components/sidebar.blade.php ENDPATH**/ ?>