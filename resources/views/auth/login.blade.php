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
    @if(config('services.google.enabled'))
      <div class="flex flex-col gap-2">
        <a
          href="{{route('auth.google')}}"
          class="w-full bg-base-100 border flex gap-2 p-3 rounded-xl shadow-sm hover:bg-base-200 cursor-pointer">
          <x-icon-google-color class="w-6 h-6"/>
          Masuk dengan Google
        </a>
      </div>
      <div
        class="flex items-center before:mt-0.5 before:flex-1 before:border-t before:border-neutral-300 after:mt-0.5 after:flex-1 after:border-t after:border-neutral-300">
        <p
          class="mx-4 mb-0 text-center font-semibold">
          atau
        </p>
      </div>
    @endif
    <form class="mt-8 space-y-6" action="{{route('login')}}" method="POST">
      @csrf
      <div class="">
        <label for="user" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
        <input
          id="user"
          name="email"
          required
          class="f-input"
          value="{{old('email')}}"
          type="text" placeholder="">
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
    <div
      class="flex items-center justify-center">
      <a href="{{route('frontend.index')}}" class=" text-gray-400 hover:text-gray-600 transition ease-in duration-150">
        <x-lucide-home class=" w-8 h-8"/>
      </a>
    </div>
  </div>
</x-layouts.auth>
