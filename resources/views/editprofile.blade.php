<!DOCTYPE html>
<html lang="id">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Edit Profile</title>
      @vite('resources/css/app.css')
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
      <link rel="icon" href="{{ asset('gambar/fixlogo.png') }}" type="image/png">
  </head>
  <body class="bg-[#F9E2AF]">
      <div class="flex h-screen overflow-hidden">
          <!-- Sidebar -->
          <x-sidebar></x-sidebar>

          <!-- Konten -->
          <div class="bg-[#FFFFFF] text-4xl text-center w-[1430px] flex-1 rounded-md m-2 ml-1 border border-[#000000] overflow-y-auto">
              <!-- Header -->
              <x-header></x-header>

              <!-- Konten Edit Profil -->
              <div class="flex flex-col items-center mt-7">
                  <!-- Pesan Sukses/Error -->
                  @if (session('success'))
                      <div class="bg-green-100 text-green-800 p-4 rounded mb-4 w-[800px]">
                          {{ session('success') }}
                      </div>
                  @endif
                  @if (session('error'))
                      <div class="bg-red-100 text-red-800 p-4 rounded mb-4 w-[800px]">
                          {{ session('error') }}
                      </div>
                  @endif
                  @if ($errors->any())
                      <div class="bg-red-100 text-red-800 p-4 rounded mb-4 w-[800px]">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  

                  <!-- Form Edit Profil -->
                  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="w-[800px] space-y-6 text-left text-[16px]">
                      @csrf
                      @method('PATCH')

                      <!-- Foto Profil -->
                      <div class="flex justify-start w-[800px] mb-10">
                          <div class="relative">
                              <img id="profile-preview" src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('gambar/user.png') }}" alt="Foto Profil" class="w-[120px] h-[120px] rounded-full border border-[#000000] object-cover">
                              <label for="profile_picture" class="absolute bottom-0 right-0 bg-[#F58E4A] text-white text-xs font-semibold px-2 py-1 rounded-full cursor-pointer hover:bg-[#f56c4a]">
                                  Ganti
                              </label>
                              <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="previewProfilePicture(event)">
                          </div>
                      </div>

                      <!-- Nama -->
                      <div>
                          <label for="name" class="font-semibold text-gray-700">Nama</label>
                          <input type="text" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nama Anda" class="w-full border-b-2 border-gray-400 py-3 outline-none my-5 @error('name')  @enderror">
                          @error('name')
                              <p class="text-red-500 text-sm">{{ $message }}</p>
                          @enderror
                      </div>

                      <!-- Email -->
                      <div>
                          <label for="email" class="font-semibold text-gray-700">Email</label>
                          <div class="flex items-center justify-between border-b-2 border-gray-400 my-5">
                              <input type="email" id="email" value="{{ Auth::user()->email }}" class="w-full outline-none text-gray-500 bg-gray-50 py-3" disabled>
                              <button type="button" onclick="openEmailPopup()" class="text-[#F58E4A] font-semibold text-sm ml-2 hover:underline cursor-pointer">Ganti</button>
                          </div>
                      </div>

                      <!-- Deskripsi -->
                      <div>
                          <label for="profile_description" class="font-semibold text-gray-700">Tentang Kamu</label>
                          <textarea id="profile_description" name="profile_description" placeholder="“Nama, umur, terserah apa aja”" class="w-full border-b-2 border-gray-400 outline-none my-5 py-3 text-gray-500 @error('profile_description')  @enderror">{{ old('profile_description', Auth::user()->profile_description) }}</textarea>
                          @error('profile_description')
                              <p class="text-red-500 text-sm">{{ $message }}</p>
                          @enderror
                      </div>

                      <!-- Tombol -->
                      <div class="flex justify-between items-center my-4">
                          <div class="w-1/2 flex justify-center">
                              <button type="submit" class="bg-[#F58E4A] text-white w-[200px] font-semibold py-5 rounded-md hover:bg-[#f56c4a] transition cursor-pointer">Perbarui</button>
                          </div>
                          <div class="w-1/2 flex justify-center">
                              <a href="{{ route('profile.show') }}" class="bg-[#F58E4A] text-white w-[200px] font-semibold py-5 rounded-md hover:bg-[#f56c4a] transition cursor-pointer text-center">Batal</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <x-clickedprofile></x-clickedprofile>

      <!-- Popup Ganti Email -->
      <div id="email-popup-wrapper" class="fixed inset-0 z-50 hidden items-center justify-center min-h-screen bg-black/30 backdrop-blur-sm">
          <div id="gantiemail" class="relative bg-white rounded-xl border border-black shadow-lg w-[500px] p-6">
              <div class="relative mb-4">
                  <div class="flex items-center space-x-2">
                      <h2 class="text-lg">Ganti Alamat Email</h2>
                  </div>
                  <button class="absolute right-0 top-0 text-xl cursor-pointer" onclick="closeEmailPopup()">×</button>
              </div>
              <form action="{{ route('profile.update.email') }}" method="POST" class="mt-6 space-y-3 text-[14px] text-gray-600">
                  @csrf
                  @method('PATCH')
                  <p>Masukkan alamat email baru dan kata sandi Anda untuk konfirmasi.</p>
                  <input type="email" name="email" placeholder="Alamat email baru" value="{{ old('email') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('email')  @enderror" />
                  @error('email')
                      <p class="text-red-500 text-sm">{{ $message }}</p>
                  @enderror
                  <input type="password" name="password" placeholder="Kata sandi saat ini" class="w-full border border-gray-300 rounded-lg px-4 py-2 mt-3 focus:outline-none focus:ring-2 focus:ring-orange-400 @error('password') @enderror" />
                  @error('password')
                      <p class="text-red-500 text-sm">{{ $message }}</p>
                  @enderror
                  <p>Alamat email saat ini: <span class="font-semibold text-black">{{ Auth::user()->email }}</span></p>
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

          document.getElementById('email-popup-wrapper').addEventListener('click', function(event) {
              const popup = document.getElementById('gantiemail');
              if (!popup.contains(event.target)) {
                  closeEmailPopup();
              }
          });
      </script>
  </body>
</html>
