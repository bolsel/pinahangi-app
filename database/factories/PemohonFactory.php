<?php

namespace Database\Factories;

use App\Models\Pemohon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemohonFactory extends Factory
{
    protected $model = Pemohon::class;

    public function definition(): array
    {
        return [
            'nohp' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
        ];
    }
}
