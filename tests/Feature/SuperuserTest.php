<?php

namespace Tests\Feature;

use App\Livewire\OrganisasiForm;
use App\Models\Organisasi;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire;
use Tests\TestCase;

class SuperuserTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->state(['role' => User::ROLE_SU])->create();

    }

    public function test_organisasi_form(): void
    {
        $this->actingAs($this->user)
            ->get(route('app.organisasi.form'))
            ->assertSeeLivewire(OrganisasiForm::class);
    }

    public function test_add_organisasi(): void
    {
        $nama = fake()->name;
        $alamat = fake()->address;
        Livewire::test(OrganisasiForm::class)
            ->set('nama', $nama)
            ->set('alamat', $alamat)
            ->call('save')
            ->assertStatus(200);
        $this->assertDatabaseHas(Organisasi::class, ['nama' => $nama, 'alamat' => $alamat]);
    }
}
