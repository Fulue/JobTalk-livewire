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
        $professions = Profession::factory(5)->create()->each(fn($profession) => Level::factory(3)->create([
            'profession_id' => $profession->id,
        ]));

        // Создание тегов
        $tags = Tag::factory(10)->create();

        // Для каждого пользователя создаем несколько видео
        $users->each(function ($user) use ($professions, $tags) {
            // Для каждого видео выбираем случайную профессию и случайный уровень этой профессии
            $profession = $professions->random();
            $levels = Level::where('profession_id', $profession->id)->get();  // Уровни этой профессии

            $videos = Video::factory(3)->create([
                'user_id' => $user->id,
                'level_id' => $levels->random()->id,  // Случайный уровень из профессии
            ]);

            // Для каждого видео создаем вопросы, таймкоды и ответы
            $videos->each(function ($video) use ($tags) {
                $questions = Question::factory(3)->create([
                    //'video_id' => $video->id,
                ]);

                // Привязка вопросов к тегам
                $questions->each(fn($question) => $question->tags()->attach($tags->random(2)));

                // Для каждого вопроса создаем таймкоды и ответы
                $questions->each(function ($question) use ($video) {
                    Timestamp::factory(2)->create([
                        'video_id' => $video->id,
                        'question_id' => $question->id,
                    ]);

                    // Создание ответов для каждого вопроса
                    Answer::factory(2)->create([
                        'question_id' => $question->id,
                    ]);
                });
            });
        });
    }
}
