<?php

namespace Database\Factories;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition(): array
    {
        // Шаблоны ответов
        $templates = [
            'Основные принципы {topic} включают {answer}.',
            'Ключевая особенность {topic} заключается в {answer}.',
            'Для работы с {topic} важно учитывать {answer}.',
            'Типичная ошибка в {topic} - это {answer}.',
            'Использование {topic} может улучшить {answer}.',
            '{topic} решает проблему {answer}.',
            'Лучший подход к {topic} - это {answer}.',
            '{answer} является основным преимуществом {topic}.',
            'Для тестирования {topic} рекомендуется использовать {answer}.',
            'Наиболее популярные инструменты для {topic} - это {answer}.',
        ];

        // Ответы на вопросы
        $answers = [
            'инкапсуляция, наследование и полиморфизм',
            'оптимизация производительности',
            'безопасность данных',
            'использование неверных типов данных',
            'лучшую модульность и повторное использование кода',
            'снижение сложности архитектуры',
            'использование паттернов проектирования',
            'повышение гибкости и адаптивности к изменениям',
            'unit-тесты и интеграционные тесты',
            'Postman, PHPUnit, Jenkins, Docker',
        ];

        // Получаем связанный вопрос
        $question = Question::factory();

        // Замена {topic} на тему вопроса
        $topic = $this->faker->word; // Или используй реальные темы, если они есть в вопросе
        $template = $this->faker->randomElement($templates);
        $answer = $this->faker->randomElement($answers);

        // Генерация финального ответа
        $finalAnswer = str_replace(['{topic}', '{answer}'], [$topic, $answer], $template);

        return [
            'answer' => $finalAnswer, // Генерация ответа
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
