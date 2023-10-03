<?php

namespace App\Providers;

use App\Models\User;
use Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('su', function (User $user) {
            return $user->roleIsSuperuser();
        });
        Gate::define('roleIsUser', function (User $user) {
            return $user->roleIsUser();
        });
        Gate::define('roleIsOrganisasi', function (User $user, ?int $organisasi_id = null) {
            if ($organisasi_id)
                return $user->roleIsOrganisasi() && $user->organisasi_id === $organisasi_id;
            return $user->roleIsOrganisasi();
        });
        Gate::define('roleIsTelaah', function (User $user) {
            return $user->roleIsTelaah();
        });
        Gate::define('permohonan.index', function (User $user) {
            return $user->roleIsSuperuser() || $user->roleIsOrganisasi() || $user->roleIsTelaah();
        });
        Gate::define('permohonan.verifikasi', function (User $user) {
            return $user->roleIsSuperuser() || $user->roleIsVerifikasi();
        });
        Gate::define('permohonan.prosess', function (User $user) {
            return $user->roleIsOrganisasi();
        });
        Gate::define('permohonan.telaah', function (User $user) {
            return $user->roleIsSuperuser() || $user->roleIsTelaah();
        });
    }
}
