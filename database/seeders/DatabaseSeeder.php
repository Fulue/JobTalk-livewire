<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profession;
use App\Models\Level;
use App\Models\Tag;
use App\Models\Video;
use App\Models\Question;
use App\Models\Timestamp;
use App\Models\Answer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создание пользователей
        $users = User::factory(10)->create();

        // Создание профессий и уровней для каждой профессии
        $professions = Profession::factory(9)->create()->each(function ($profession) {
            Level::factory(3)->create([
                'profession_id' => $profession->id,
            ]);
        });

        // Создание тегов
        $tags = Tag::factory(10)->create();

        // Для каждой профессии создаем видео, вопросы и т.д.
        $professions->each(function ($profession) use ($tags, $users) {
            // Получаем уровни для этой профессии
            $levels = Level::where('profession_id', $profession->id)->get();

            // Перебираем уровни и создаем уникальные видео для каждого уровня
            $levels->each(function ($level) use ($profession, $tags, $users) {
                // Создаем видео с уникальным уровнем для каждого уровня
                Video::factory(rand(2, 4))->create([
                    'user_id' => $users->random()->id,
                    'profession_id' => $profession->id,
                    'level_id' => $level->id, // Используем уникальный уровень для каждого видео
                ])->each(function ($video) use ($tags) {
                    // Для каждого видео создаем вопросы
                    $questions = Question::factory(rand(1, 5))->create([
                        'level_id' => $video->level_id,
                        'profession_id' => $video->profession_id,
                    ]);

                    // Привязываем случайные теги к вопросам
                    $questions->each(fn($question) => $question->tags()->attach($tags->random(2)));

                    // Для каждого вопроса создаем таймкоды и ответы
                    $questions->each(function ($question) use ($video) {
                        // Создаем таймкоды
                        Timestamp::factory(rand(3, 10))->create([
                            'video_id' => $video->id,
                            'question_id' => $question->id,
                        ]);

                        // Создаем ответы для каждого вопроса
                        Answer::factory(2)->create([
                            'question_id' => $question->id,
                        ]);
                    });
                });
            });
        });
    }

}
