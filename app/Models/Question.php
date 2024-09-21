<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 *
 * @property string $id
 * @property string $question
 * @property string $profession_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 *
 * @property-read User $user
 * @property-read Profession $profession
 * @property-read Level $level
 * @property-read Answer[]|HasMany $answers
 * @property-read Timestamp[]|HasMany $timestamps
 * @property-read Tag[]|BelongsToMany $tags
 */
class Question extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = [
        'question',
        'profession_id',
    ];

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
     * Связь вопроса с таймкодами (один ко многим)
     *
     * @return HasMany
     */
    public function timestamps(): HasMany
    {
        return $this->hasMany(Timestamp::class);
    }


    /**
     * Связь вопроса с тегами (многие ко многим)
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'question_tag');
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
     * Связь вопроса с пользователем (многие к одному)
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
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
}
