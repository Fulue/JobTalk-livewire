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
        // Список профессий
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

        // Список иконок (используем библиотеку MDI как пример)
        $icons = [
            'mdi-laravel',
            'mdi-react',
            'mdi-php',
            'mdi-database',
            'mdi-cube',
            'mdi-laptop',
            'mdi-robot',
            'mdi-server',
            'mdi-cloud',
            'mdi-pencil',
            'mdi-lock',
            'mdi-chart-line',
            'mdi-flask',
            'mdi-network',
            'mdi-sitemap',
            'mdi-chart-pie',
            'mdi-bug',
            'mdi-api',
            'mdi-cellphone',
        ];

        // Список цветов для иконок
        $colors = [
            'text-red-500',
            'text-blue-500',
            'text-green-500',
            'text-yellow-500',
            'text-purple-500',
            'text-pink-500',
            'text-teal-500',
            'text-orange-500',
            'text-indigo-500',
        ];

        return [
            'name' => $this->faker->randomElement($professions),
            'icon' => $this->faker->randomElement($icons),
            'icon_color' => $this->faker->randomElement($colors),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
