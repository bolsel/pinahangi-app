<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Organisasi;
use App\Models\Pemohon;
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
//        User::factory()->create([
//            'name' => 'Pemohon User',
//            'email' => 'pemohon@bolselkab.go.id',
//            'password' => 'password',
//            'role' => 'user'
//        ]);
        User::factory()->create([
            'name' => 'Verifikasi User',
            'email' => 'verifikasi@bolselkab.go.id',
            'password' => 'password',
            'role' => 'verif'
        ]);
        User::factory()->create([
            'name' => 'Telaah User',
            'email' => 'telaah@bolselkab.go.id',
            'password' => 'password',
            'role' => 'telaah'
        ]);
        Pemohon::factory(100)->state(fn($attributes) => [
            'user_id' => User::factory()
        ])->create();
        Organisasi::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
