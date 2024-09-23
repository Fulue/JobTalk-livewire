<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        $tags = [
            'Общие вопросы',
            'ООП',
            'Алгоритмы',
            'Базы данных',
            'Тестирование',
            'Архитектура',
            'PHP',
            'JavaScript',
            'HTML/CSS',
            'DevOps',
            'Системы контроля версий',
            'REST API',
            'Микросервисы',
            'Безопасность',
            'Машинное обучение',
            'Реактивное программирование',
            'Функциональное программирование',
            'Паттерны проектирования',
            'Фреймворки',
            'Оптимизация производительности',
        ];

        $colors = [
            'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-white',
            'bg-gray-50 text-gray-500 dark:bg-white/10 dark:text-white',
            'bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500',
            'bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500',
            'bg-red-100 text-red-800 dark:bg-red-800/30 dark:text-red-500',
        ];

        $icons = [
            'mdi-tag',
            'mdi-code-tags',
            'mdi-database',
            'mdi-test-tube',
            'mdi-cogs',
            'mdi-language-php',
            'mdi-language-javascript',
            'mdi-file-code',
            'mdi-server',
            'mdi-git',
            'mdi-cloud',
            'mdi-shield',
            'mdi-chart-line',
            'mdi-book-open',
            'mdi-function',
            'mdi-pattern',
            'mdi-rocket',
            'mdi-speedometer',
        ];

        return [
            'tag' => $this->faker->randomElement($tags), // Случайный тег из списка
            'color' => $this->faker->randomElement($colors), // Случайный цвет из списка
            'icon' => $this->faker->randomElement($icons),  // Случайная иконка из списка
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}
