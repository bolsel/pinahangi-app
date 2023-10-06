<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\File;
use App\Models\Organisasi;
use App\Models\Pemohon;
use App\Models\Permohonan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Superuser',
            'email' => 'su@bolselkab.go.id',
            'password' => 'password',
            'role' => User::ROLE_SU
        ]);
        User::factory()->create([
            'name' => 'Verifikasi User',
            'email' => 'verifikasi@bolselkab.go.id',
            'password' => 'password',
            'role' => User::ROLE_VERIFIKASI
        ]);
        User::factory()->create([
            'name' => 'Telaah User',
            'email' => 'telaah@bolselkab.go.id',
            'password' => 'password',
            'role' => User::ROLE_TELAAH
        ]);

        User::factory(15)->state(fn($attributes) => [
            'role' => User::ROLE_ORGANISASI,
            'organisasi_id' => Organisasi::factory()
        ])->create();

        Pemohon::factory(20)->state(fn($attributes) => [
            'user_id' => User::factory()
        ])->create();
        Permohonan::factory(20)->state(fn() => [
            'pemohon_id' => Pemohon::all()->random()
        ])->create();
        File::factory(10)->state(fn() => [
            'user_id' => User::all()->random()
        ])->create();

    }
}
