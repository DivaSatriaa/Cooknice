<!DOCTYPE html>
<html lang="id">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
      <title>Edit Profile</title>
      <link rel="stylesheet" href="<?php echo e(asset('build/assets/app-CMmxYR91.css')); ?>" >
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
      <link rel="icon" href="<?php echo e(asset('gambar/fixlogo.png')); ?>" type="image/png">
  </head>
  <body class="bg-[#F9E2AF]">
      <div class="flex h-screen overflow-hidden">
          <!-- Sidebar -->
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

          <!-- Konten -->
          <div class="bg-[#FFFFFF] text-4xl text-center w-[1430px] flex-1 rounded-md m-2 ml-1 border border-[#000000] overflow-y-auto">
              <!-- Header -->
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

              <!-- Konten Edit Profil -->
              <div class="flex flex-col items-center mt-7">
                  <!-- Pesan Sukses/Error -->
                  <?php if(session('success')): ?>
                      <div class="bg-green-100 text-green-800 p-4 rounded mb-4 w-[800px]">
                          <?php echo e(session('success')); ?>

                      </div>
                  <?php endif; ?>
                  <?php if(session('error')): ?>
                      <div class="bg-red-100 text-red-800 p-4 rounded mb-4 w-[800px]">
                          <?php echo e(session('error')); ?>

                      </div>
                  <?php endif; ?>
                  <?php if($errors->any()): ?>
                      <div class="bg-red-100 text-red-800 p-4 rounded mb-4 w-[800px]">
                          <ul>
                              <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                  <li><?php echo e($error); ?></li>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ul>
                      </div>
                  <?php endif; ?>

                  

                  <!-- Form Edit Profil -->
                  <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="w-[800px] space-y-6 text-left text-[16px]">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>

                      <!-- Foto Profil -->
                      <div class="flex justify-start w-[800px] mb-10">
                          <div class="relative">
                              <img id="profile-preview" src="<?php echo e(Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('gambar/user.png')); ?>" alt="Foto Profil" class="w-[120px] h-[120px] rounded-full border border-[#000000] object-cover">
                              <label for="profile_picture" class="absolute bottom-0 right-0 bg-[#F58E4A] text-white text-xs font-semibold px-2 py-1 rounded-full cursor-pointer hover:bg-[#f56c4a]">
                                  Ganti
                              </label>
                              <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="previewProfilePicture(event)">
                          </div>
                      </div>

                      <!-- Nama -->
                      <div>
                          <label for="name" class="font-semibold text-gray-700">Nama</label>
                          <input type="text" id="name" name="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" placeholder="Nama Anda" class="w-full border-b-2 border-gray-400 py-3 outline-none my-5 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                          <?php $__errorArgs = ['name'];
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

                      <!-- Email -->
                      <div>
                          <label for="email" class="font-semibold text-gray-700">Email</label>
                          <div class="flex items-center justify-between border-b-2 border-gray-400 my-5">
                              <input type="email" id="email" value="<?php echo e(Auth::user()->email); ?>" class="w-full outline-none text-gray-500 bg-gray-50 py-3" disabled>
                              <button type="button" onclick="openEmailPopup()" class="text-[#F58E4A] font-semibold text-sm ml-2 hover:underline cursor-pointer">Ganti</button>
                          </div>
                      </div>

                      <!-- Deskripsi -->
                      <div>
                          <label for="profile_description" class="font-semibold text-gray-700">Tentang Kamu</label>
                          <textarea id="profile_description" name="profile_description" placeholder="“Nama, umur, terserah apa aja”" class="w-full border-b-2 border-gray-400 outline-none my-5 py-3 text-gray-500 <?php $__errorArgs = ['profile_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('profile_description', Auth::user()->profile_description)); ?></textarea>
                          <?php $__errorArgs = ['profile_description'];
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

                      <!-- Tombol -->
                      <div class="flex justify-between items-center my-4">
                          <div class="w-1/2 flex justify-center">
                              <button type="submit" class="bg-[#F58E4A] text-white w-[200px] font-semibold py-5 rounded-md hover:bg-[#f56c4a] transition cursor-pointer">Perbarui</button>
                          </div>
                          <div class="w-1/2 flex justify-center">
                              <a href="<?php echo e(route('profile.show')); ?>" class="bg-[#F58E4A] text-white w-[200px] font-semibold py-5 rounded-md hover:bg-[#f56c4a] transition cursor-pointer text-center">Batal</a>
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

      <!-- Popup Ganti Email -->
      <div id="email-popup-wrapper" class="fixed inset-0 z-50 hidden items-center justify-center min-h-screen bg-black/30 backdrop-blur-sm">
          <div id="gantiemail" class="relative bg-white rounded-xl border border-black shadow-lg w-[500px] p-6">
              <div class="relative mb-4">
                  <div class="flex items-center space-x-2">
                      <h2 class="text-lg">Ganti Alamat Email</h2>
                  </div>
                  <button class="absolute right-0 top-0 text-xl cursor-pointer" onclick="closeEmailPopup()">×</button>
              </div>
              <form action="<?php echo e(route('profile.update.email')); ?>" method="POST" class="mt-6 space-y-3 text-[14px] text-gray-600">
                  <?php echo csrf_field(); ?>
                  <?php echo method_field('PATCH'); ?>
                  <p>Masukkan alamat email baru dan kata sandi Anda untuk konfirmasi.</p>
                  <input type="email" name="email" placeholder="Alamat email baru" value="<?php echo e(old('email')); ?>" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  <input type="password" name="password" placeholder="Kata sandi saat ini" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-3 focus:outline-none focus:ring-2 focus:ring-orange-400 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" />
                  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                      <p class="text-red-500 text-sm"><?php echo e($message); ?></p>
                  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  <p>Alamat email saat ini: <span class="font-semibold text-black"><?php echo e(Auth::user()->email); ?></span></p>
                  <div class="flex justify-center mt-4">
                      <button type="submit" class="w-[250px] bg-orange-400 hover:bg-orange-500 text-white font-semibold py-2 rounded-md transition cursor-pointer">Kirim</button>
                  </div>
              </form>
          </div>
      </div>

      <!-- Script -->
      <script>
          // Preview Foto Profil
          function previewProfilePicture(event) {
              const reader = new FileReader();
              reader.onload = function() {
                  const output = document.getElementById('profile-preview');
                  output.src = reader.result;
              };
              reader.readAsDataURL(event.target.files[0]);
          }

          // Popup Ganti Email
          function openEmailPopup() {
              const wrapper = document.getElementById('email-popup-wrapper');
              wrapper.classList.remove('hidden');
              wrapper.classList.add('flex');
              document.body.style.overflow = 'hidden';
          }

          function closeEmailPopup() {
              const wrapper = document.getElementById('email-popup-wrapper');
              wrapper.classList.remove('flex');
              wrapper.classList.add('hidden');
              document.body.style.overflow = 'auto';
          }

          // Tutup popup saat klik di luar kotak popup
          document.getElementById('email-popup-wrapper').addEventListener('click', function(event) {
              const popup = document.getElementById('gantiemail');
              if (!popup.contains(event.target)) {
                  closeEmailPopup();
              }
          });
      </script>
  </body>
</html>
<?php /**PATH C:\Users\ASUS\Cooknice2\resources\views/editprofile.blade.php ENDPATH**/ ?>