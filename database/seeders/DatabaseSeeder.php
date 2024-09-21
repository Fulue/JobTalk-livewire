<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Level;
use App\Models\Profession;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Timestamp;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создание пользователей
        User::factory(2)->create()->each(function ($user) {
            // Для каждого пользователя создаём 2 видео
            $videos = Video::factory(2)->create(['user_id' => $user->id]);

            // Для каждого видео создаём таймкоды и вопросы
            $videos->each(function ($video) {
                $questions = Question::factory(3)->create(['user_id' => $video->user_id]);

                // Для каждого вопроса создаём таймкоды
                $questions->each(function ($question) use ($video) {
                    Timestamp::factory(2)->create([
                        'video_id' => $video->id,
                        'question_id' => $question->id,
                    ]);

                    // Для каждого вопроса создаём 2 ответа
                    Answer::factory(2)->create(['question_id' => $question->id]);
                });
            });
        });

        // Создание профессий
        Profession::factory(5)->create()->each(fn($profession) => Question::factory(5)->create(['profession_id' => $profession->id]));

        // Создание уровней
        Level::factory(3)->create()->each(fn($level) => Question::factory(3)->create(['level_id' => $level->id]));

        // Создание тегов и присвоение тегов к вопросам
        Tag::factory(5)->create()->each(function ($tag) {
            // Для каждого тега выбираем случайные вопросы и связываем их
            $questions = Question::inRandomOrder()->take(3)->get();
            foreach ($questions as $question) {
                $question->tags()->attach($tag);
            }
        });

    }
}
