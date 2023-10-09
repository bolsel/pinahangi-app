<x-layouts.auth title="Mendaftar">
  <div class="space-y-8">
    <div class="text-center">
      <h2 class="mt-6 text-3xl font-bold text-gray-900">
        Mendaftar
      </h2>
      <p class="mt-2 text-sm text-gray-500">Silahkan masukan informasi akun untuk mendaftar baru.</p>
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
          Mendaftar dengan Google
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
    <form class="mt-8 space-y-6" action="{{route('register')}}" method="POST" x-data="{showPass: false}">
      @csrf
      <div class="w-full">
        <label for="email" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email<span
            class="text-red-600 font-bold">*</span></label>
        <input
          id="email"
          name="email"
          required
          class="f-input"
          value="{{old('email')}}"
          type="email" placeholder="">
        @error('email')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="w-full">
        <label for="name" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Nama Lengkap<span
            class="text-red-600 font-bold">*</span></label>
        <input
          id="name"
          name="name"
          required
          class="f-input"
          value="{{old('name')}}"
          type="text" placeholder="">
        @error('name')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="relative">
        <div class="absolute right-3 top-[50%]">
          <button type="button" class="text-gray-600" @click="showPass=!showPass">
            <span x-show="!showPass"><x-lucide-eye class="w-6 h-6"/></span>
            <span x-show="showPass"><x-lucide-eye-off class="w-6 h-6"/></span>
          </button>
        </div>
        <label for="pass" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Password<span
            class="text-red-600 font-bold">*</span></label>
        <input
          id="pass"
          name="password"
          required
          class="f-input"
          :type="showPass ? 'text' : 'password'"
          placeholder="*****" value="">
        @error('password')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="">
        <label for="pass2" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Konfirmasi Password<span
            class="text-red-600 font-bold">*</span></label>
        <input
          id="pass2"
          name="password_confirmation"
          required
          class="f-input"
          :type="showPass ? 'text' : 'password'"
          placeholder="*****" value="">
        @error('password_confirmation')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>


      <div>
        <button
          type="submit"
          class="w-full flex justify-center bg-gradient-to-r from-primary to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
          Mendaftar
        </button>
      </div>
      <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
        <span>Sudah punya akun?</span>
        <a href="{{route('login')}}"
           class="text-indigo-400 hover:text-blue-500 no-underline hover:underline cursor-pointer transition ease-in duration-300">Masuk</a>
      </p>
    </form>
  </div>
</x-layouts.auth>
