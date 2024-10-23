<?php

namespace App\Models;

use App\Observers\QuestionObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Question
 *
 * @property string $id
 * @property string $question
 * @property float $percentage
 * @property Timestamp[]|BelongsToMany $timestamps
 * @property Answer[]|HasMany $answers
 * @property Tag[]|MorphToMany $tags
 * @property Profession $profession
 * @property Level $level
 */
#[ObservedBy([QuestionObserver::class])]
class Question extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = ['question', 'profession_id', 'level_id', 'percentage'];

    /**
     * Связь вопроса с ответами (один ко многим)
     *
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * Определяет связь вопроса с тайм-кодами (многие ко многим)
     *
     * @return BelongsToMany
     */
    public function timestamps(): BelongsToMany
    {
        return $this->belongsToMany(Timestamp::class)->withPivot('similarity');
    }

    /**
     * Определяет связь вопроса с тегами (многие ко многим) через морфологическую таблицу.
     *
     *
     * @return MorphToMany
     */
    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    /**
     * Связь вопроса с профессией (многие к одному)
     *
     * @return BelongsTo
     */
    public function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    }

    /**
     * Связь вопроса с уровнем (многие к одному)
     *
     * @return BelongsTo
     */
    public function level(): BelongsTo
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Пересчитывает процент каждого вопроса на основе общего количества тайм-кодов.
     *
     * @return void
     */
    public static function recalculatePercentages()
    {
        // Получаем все вопросы с количеством связанных таймкодов
        $questions = Question::withCount('timestamps')->get();

        // Находим максимальное и минимальное количество таймкодов
        $maxTimestampsCount = $questions->max('timestamps_count');
        $minTimestampsCount = $questions->min('timestamps_count');

        // Определяем диапазон процентов
        $minPercentage = 30;
        $maxPercentage = 95;

        // Если нет таймкодов, устанавливаем процент 0 для всех вопросов
        if ($maxTimestampsCount == 0) {
            foreach ($questions as $question) {
                $question->update(['percentage' => 0]);
            }
            return;
        }

        // Рассчитываем проценты для каждого вопроса
        foreach ($questions as $question) {
            if ($maxTimestampsCount == $minTimestampsCount) {
                // Если все вопросы имеют одинаковое количество таймкодов
                $percentage = $maxPercentage;
            } else {
                // Пропорциональный расчет процентов между 70 и 90%
                $percentage = $minPercentage + (($question->timestamps_count - $minTimestampsCount) / ($maxTimestampsCount - $minTimestampsCount)) * ($maxPercentage - $minPercentage);
            }

            // Обновляем процент для каждого вопроса
            $question->update(['percentage' => $percentage]);
        }
    }


}
