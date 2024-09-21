<?php

namespace Database\Factories;

use App\Models\Profession;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition(): array
    {
        // Список тем для вопросов
        $topics = [
            'ООП',
            'Алгоритмы',
            'Базы данных',
            'Тестирование',
            'Архитектура',
            'PHP',
            'JavaScript',
            'REST API',
            'Микросервисы',
            'Безопасность',
            'Машинное обучение',
            'Оптимизация производительности',
            'Фреймворки',
        ];

        // Шаблоны вопросов
        $templates = [
            'Что такое {topic} и как оно работает?',
            'Какие основные принципы {topic}?',
            'Как использовать {topic} в реальных проектах?',
            'Расскажите о преимуществах {topic}.',
            'Каковы типичные ошибки при работе с {topic}?',
            'В чем отличие {topic} от других технологий?',
            'Как улучшить производительность с помощью {topic}?',
            'Объясните, почему {topic} важен(а) для разработки.',
            'Как тестировать {topic}?',
            'Какие инструменты можно использовать для {topic}?',
        ];

        // Выбор случайной темы и шаблона
        $topic = $this->faker->randomElement($topics);
        $template = $this->faker->randomElement($templates);

        // Генерация вопроса
        $question = str_replace('{topic}', $topic, $template);

        return [
            'question' => $question, // Генерируемый вопрос
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

}
