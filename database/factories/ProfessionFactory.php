<?php

namespace Database\Factories;

use App\Models\Profession;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ProfessionFactory extends Factory
{
    protected $model = Profession::class;

    public function definition(): array
    {
        $professions = [
            'PHP-разработчик',
            'Frontend-разработчик',
            'Backend-разработчик',
            'DevOps-инженер',
            'Data Scientist',
            'Мобильный разработчик',
            'Full Stack разработчик',
            'Системный администратор',
            'Machine Learning инженер',
            'Cloud инженер',
            'UI/UX дизайнер',
            'Инженер по безопасности',
            'Аналитик данных',
            'QA-инженер',
            'Сетевой инженер',
            'Scrum мастер',
            'Продуктовый менеджер',
            'Аналитик бизнес процессов',
            'IoT-инженер',
        ];

        return [
            'name' => $this->faker->randomElement($professions), // Случайная профессия из списка
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
