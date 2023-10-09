<x-layouts.auth title="Masuk">
  <div class="space-y-8">
    <div class="text-center">
      <h2 class="mt-6 text-3xl font-bold text-gray-900">
        Lupa Password
      </h2>
      <p class="mt-2 text-sm text-gray-500">Reset ulang kata sandi anda.</p>
    </div>
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <form class="mt-8 space-y-6" action="{{route('password.request')}}" method="POST">
      @csrf
      <div class="">
        <label for="email" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
        <input
          id="email"
          name="email"
          required
          class="f-input"
          type="email" placeholder="*****" value="">
        @error('email')
        <div class="text-error p-2">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div>
        <button
          type="submit"
          class="w-full flex justify-center bg-gradient-to-r from-primary to-blue-600 hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4 rounded-full tracking-wide font-semibold shadow-lg cursor-pointer transition ease-in duration-500">
          Reset Password
        </button>
      </div>
      <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
        <span>Ingat password?</span>
        <a href="{{route('login')}}"
           class="text-indigo-400 hover:text-blue-500 no-underline hover:underline cursor-pointer transition ease-in duration-300">Masuk</a>
      </p>
    </form>
  </div>
</x-layouts.auth>
