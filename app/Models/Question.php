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
    public static function recalculatePercentages(): void
    {
        // Получаем все вопросы с количеством связанных таймкодов и тегов
        $questions = Question::withCount(['timestamps', 'tags'])->get();

        // Находим максимальное и минимальное количество таймкодов
        $maxTimestampsCount = $questions->max('timestamps_count');
        $minTimestampsCount = $questions->min('timestamps_count');

        // Находим максимальное и минимальное количество тегов
        $maxTagsCount = $questions->max('tags_count');
        $minTagsCount = $questions->min('tags_count');

        // Определяем диапазон процентов
        $minPercentage = 10.4;
        $maxPercentage = 96.3;

        // Если нет ни таймкодов, ни тегов, устанавливаем процент 0 для всех вопросов
        if ($maxTimestampsCount == 0 && $maxTagsCount == 0) {
            foreach ($questions as $question) {
                $question->update(['percentage' => 0]);
            }
            return;
        }

        // Рассчитываем проценты для каждого вопроса
        foreach ($questions as $question) {

            // Получение данных о Similarity для каждого вопроса отдельно
            $timestamps = $question->timestamps()->withPivot('similarity')->get();

            $weightedSum = 0;
            $totalWeight = 0;

            foreach ($timestamps as $timestamp) {
                $weightedSum += $timestamp->pivot->similarity;
                $totalWeight += 100; // Адаптируйте это значение в соответствии с вашей шкалой Similarity
            }

            $normalizedSimilarity = $totalWeight > 0 ? $weightedSum / $totalWeight : 0;

            // Нормализуем вес таймкодов и тегов для расчета
            $normalizedTimestamps = $maxTimestampsCount == $minTimestampsCount
                ? 1
                : ($question->timestamps_count - $minTimestampsCount) / ($maxTimestampsCount - $minTimestampsCount);

            $normalizedTags = $maxTagsCount == $minTagsCount
                ? 1
                : ($question->tags_count - $minTagsCount) / ($maxTagsCount - $minTagsCount);

            // Комбинируем вес таймкодов и тегов (например, 70% таймкоды, 30% теги)
            $combinedWeight = 0.5 * $normalizedTimestamps + 0.3 * $normalizedTags + 0.2 * $normalizedSimilarity;

            // Пропорциональный расчет процентов между 30% и 95%
            $percentage = $minPercentage + $combinedWeight * ($maxPercentage - $minPercentage);

            // Обновляем процент для каждого вопроса
            $question->update(['percentage' => $percentage]);
        }
    }


}
