<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LevelFactory extends Factory
{
    protected $model = Level::class;

    public function definition(): array
    {
        $levels = [
            'Джуниор',
            'Мидл',
            'Сеньор',
            'Лид',
            'Тимлид',
            'Архитектор',
        ];

        return [
            'name' => $this->faker->randomElement($levels), // Случайный уровень из списка
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
