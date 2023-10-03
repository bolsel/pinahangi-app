<x-layouts.auth title="Masuk">
  <div class="space-y-8">
    <div class="text-center">
      <h2 class="mt-6 text-3xl font-bold text-gray-900">
        Reset Password
      </h2>
      <p class="mt-2 text-sm text-gray-500">Reset ulang kata sandi anda.</p>
    </div>
    @if (session('status'))
      <div class="alert alert-success" role="alert">
        {{ session('status') }}
      </div>
    @endif
    <form class="mt-8 space-y-6" action="{{route('password.update')}}" method="POST" x-data="{showPass: false}">
      @csrf
      <input type="hidden" name="token" value="{{ $request->route('token') }}">
      <div class="">
        <label for="email" class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
        <input
          id="email"
          name="email"
          required
          readonly
          class="f-input"
          type="email"
          value="{{ old('email',$request->email) }}"
        >
        @error('email')
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
          Reset Password
        </button>
      </div>
    </form>
  </div>
</x-layouts.auth>
