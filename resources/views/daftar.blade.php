<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Daftar Cooknice</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="icon" href="{{ asset('gambar/fixlogo.png') }}" type="image/png">

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

    <div class="flex items-center space-x-2">
      <img src="/gambar/fixtextlogo.png" class="h-[120px] w-auto object-contain" />
    </div>
  </div>
    
    <!-- Tombol Close (X) -->
    <a href="/" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</a>
    
    <!-- Pesan Sukses Atau Eror -->

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Form Login -->
    <form action="{{ route('daftar') }}" method="POST" class="space-y-6">
      @csrf
      <!-- Nama -->
      <div>
          <label for="name" class="block text-sm font-semibold font-poppins text-[#005A64] mb-1">Nama</label>
          <div class="relative">
              <input
                  type="text"
                  id="name"
                  name="name"
                  value="{{ old('name') }}"
                  class="w-full border-b-2 border-gray-400 focus:outline-none focus:border-[#005A64] pr-10 pb-1 text-[#005A64] font-semibold font-poppins"
                  placeholder="Masukkan Nama"/>
              <span class="absolute right-2 top-1.5 text-gray-400">
                  <img src="/gambar/user3.png" class="w-4 h-4"/>
              </span>
              @error('name')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
          </div>
      </div>

      <!-- Email -->
      <div>
          <label for="email" class="block text-sm font-semibold font-poppins text-[#005A64] mb-1">Email</label>
          <div class="relative">
              <input
                  type="email"
                  id="email"
                  name="email"
                  value="{{ old('email') }}"
                  class="w-full border-b-2 border-gray-400 focus:outline-none focus:border-[#005A64] pr-10 pb-1 text-[#005A64] font-semibold font-poppins"
                  placeholder="Masukkan Email"/>
              <span class="absolute right-2 top-1.5 text-gray-400">
                  <img src="/gambar/email1.png" class="w-4 h-4"/>
              </span>
              @error('email')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
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
              @error('password')
                  <span class="text-red-500 text-sm">{{ $message }}</span>
              @enderror
          </div>
      </div>

      <!-- Konfirmasi Password -->
      <div>
          <label for="password_confirmation" class="block text-sm font-semibold font-poppins text-[#005A64] mb-1">Konfirmasi Password</label>
          <div class="relative">
              <input
                  type="password"
                  id="password_confirmation"
                  name="password_confirmation"
                  class="w-full border-b-2 border-gray-400 focus:outline-none focus:border-[#005A64] pr-10 pb-1 text-[#005A64] font-semibold font-poppins"
                  placeholder="Konfirmasi Password"/>
              <span class="absolute right-2 top-1.5 text-gray-400">
                  <img src="/gambar/lock1.png" class="w-4 h-4"/>
              </span>
          </div>
      </div>


      <!-- Tombol Daftar -->
      <div class="mt-6 ml-10 mr-10 items-center justify-center flex">
          <button type="submit" class="cursor-pointer w-full bg-[#005A64] text-white items-center justify-center flex font-semibold font-poppins py-2 rounded-md hover:bg-[#004852] transition duration-200">
              DAFTAR
          </button>
      </div>
    </form>

    
    <!-- Link Login -->
    <p class="text-center text-sm text-black font-semibold font-poppins mt-6">
      Sudah punya akun? 
      <a href="/login" class="text-[#005A64] underline">Login Disini</a>
    </p>

  </div>

  

</body>
</html>
