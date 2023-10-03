<x-layouts.auth title="Masuk">
  <div class="space-y-8">
    <div class="text-center">
      <h2 class="mt-6 text-3xl font-bold text-gray-900">
        Masuk
      </h2>
      <p class="mt-2 text-sm text-gray-500">Silahkan masuk ke akun anda</p>
    </div>
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <form class="mt-8 space-y-6" action="{{route('login')}}" method="POST">
      @csrf
      <div class="">
        <label for="user" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email / Nama Pengguna</label>
        <input
          id="user"
          name="email"
          required
          class="f-input"
          type="text" placeholder="" value="">
        @error('email')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="">
        <label for="pass" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Kata Sandi</label>
        <input
          id="pass"
          name="password"
          required
          class="f-input"
          type="password" placeholder="*****" value="">
        @error('password')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember_me" name="remember_me" type="checkbox"
                 class="h-4 w-4 bg-primary focus:ring-primary border-base-100 rounded">
          <label for="remember_me" class="ml-2 block text-sm text-gray-600">
            Ingat sesi masuk
          </label>
        </div>
        <div class="text-sm">
          <a href="{{route('password.request')}}" class="text-indigo-400 hover:text-blue-500">
            Lupa password?
          </a>
        </div>
      </div>
      <div>
        <button
          type="submit"
          class="w-full flex justify-center bg-gradient-to-r from-primary to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
          Masuk
        </button>
      </div>
      <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
        <span>Belum punya akun?</span>
        <a href="{{route('register')}}"
           class="text-indigo-400 hover:text-blue-500 no-underline hover:underline cursor-pointer transition ease-in duration-300">Buat
          akun baru</a>
      </p>
    </form>
  </div>
</x-layouts.auth>