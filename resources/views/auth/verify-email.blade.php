<x-layouts.auth title="Verifikasi Email">
  <div class="space-y-8">
    <div class="text-center">
      <h2 class="mt-6 text-3xl font-bold text-gray-900">
        Verifikasi Email
      </h2>
    </div>
    @if (session('status'))
      @if(session('status') === \Laravel\Fortify\Fortify::VERIFICATION_LINK_SENT)
        <div class="alert alert-success text-xl" role="alert">
          Link verifikasi telah dikirim ulang.
        </div>
      @else
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
    @endif
    <div class="alert alert-success text-xl" role="alert">
      Sebuah email berisi link verifikasi telah dikirim ke email anda ({{Auth::user()->email}}). Klik link tersebut
      untuk memverifikasi email anda.
    </div>

    <div class="flex flex-col gap-5">
      Jika belum menerima email, klik tombol dibawah untuk mengirim ulang link verifikasi.
      <form method="POST" action="{{ route('verification.send') }}" class="text-center">
        @csrf
        <button type="submit" class="btn btn-sm normal-case">Kirim Ulang</button>
      </form>
    </div>
  </div>
</x-layouts.auth>
