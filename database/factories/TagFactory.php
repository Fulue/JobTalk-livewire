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

        return [
            'tag' => $this->faker->randomElement($tags), // Случайный тег из списка
            'color' => $this->faker->word,
            'icon' => $this->faker->word,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
