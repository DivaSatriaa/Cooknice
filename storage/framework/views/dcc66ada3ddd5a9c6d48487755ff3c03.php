<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Cooknice</title>
    <link rel="stylesheet" href="<?php echo e(asset('build/assets/app-CMmxYR91.css')); ?>" >
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" href="<?php echo e(asset('gambar/fixlogo.png')); ?>" type="image/png">
  </head>

  <body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Popup Container -->
    <div class="relative bg-[#FFFFFF] rounded-xl border-[6px] border-[#F9E2AF] shadow-lg w-full max-w-sm p-6">

      <!-- Logo dan Judul -->
      <div class="flex items-center space-x-1 mt-4 mb-6 justify-center">
        <!-- Logo bundar -->
        <div class="bg-[#F9E2AF] rounded-full p-3 flex items-center justify-center w-12 h-12">
          <img src="/gambar/fixlogo.png" class="w-11 h-11 object-cover" />
        </div>

        <!-- Teks Cooknice dengan jempol -->
        <div class="flex items-center space-x-2">
          <img src="/gambar/fixtextlogo.png" class="h-[120px] w-auto object-contain" />
        </div>
      </div>
      
      <!-- Tombol Close (X) -->
      <a href="/" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">×</a>
      
      <!-- Pesan Sukses atau Error -->
      <?php if(session('success')): ?>
          <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
              <?php echo e(session('success')); ?>

          </div>
      <?php endif; ?>
      <?php if(session('error')): ?>
          <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
              <?php echo e(session('error')); ?>

          </div>
      <?php endif; ?>
      <?php if($errors->any()): ?>
          <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
              <ul>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
      <?php endif; ?>

      <!-- Form Login -->
      <form action="<?php echo e(route('login')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>
        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-semibold font-poppins text-[#005A64] mb-1">Email</label>
          <div class="relative">
            <input
              type="email"
              id="email"
              name="email"
              value="<?php echo e(old('email')); ?>"
              class="w-full border-b-2 border-gray-400 focus:outline-none focus:border-[#005A64] pr-10 pb-1 text-[#005A64] font-semibold font-poppins"
              placeholder="Masukkan Email"/>
            <span class="absolute right-2 top-1.5 text-gray-400">
              <img src="/gambar/email1.png" class="w-4 h-4"/>
            </span>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-sm font-semibold font-poppins text-[#005A64] mb-1">Password</label>
          <div class="relative">
            <input
              type="password"
              id="password"
              name="password"
              class="w-full border-b-2 border-gray-400 focus:outline-none focus:border-[#005A64] pr-10 pb-1 text-[#005A64] font-semibold font-poppins"
              placeholder="Masukkan Password"/>
            <span class="absolute right-2 top-1.5 text-gray-400">
              <img src="/gambar/lock1.png" class="w-4 h-4"/>
            </span>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-red-500 text-sm"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
        </div>

        <!-- Tombol Masuk -->
        <div class="mt-6 ml-10 mr-10 items-center justify-center flex">
          <button type="submit" class="cursor-pointer w-full bg-[#005A64] text-white items-center justify-center flex font-semibold font-poppins py-2 rounded-md hover:bg-[#004852] transition duration-200">
            MASUK
          </button>
        </div>
      </form>

      
      <!-- Link Daftar -->
      <p class="text-center text-sm text-black font-semibold font-poppins mt-6">
        Belum punya akun? 
        <a href="/daftar" class="text-[#005A64] underline">Daftar Disini</a>
      </p>

    </div>

  </body>

</html>
<?php /**PATH C:\Users\ASUS\Cooknice2\resources\views/login.blade.php ENDPATH**/ ?>