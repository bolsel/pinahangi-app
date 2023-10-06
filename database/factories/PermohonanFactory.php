<?php

namespace Database\Factories;

use App\Models\Permohonan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermohonanFactory extends Factory
{
    protected $model = Permohonan::class;

    public function definition(): array
    {
        return [
            'permohonan' => $this->faker->paragraph(4),
            'data' => []
        ];
    }
}
