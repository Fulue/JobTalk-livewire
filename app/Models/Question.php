<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 *
 * @property string $id
 * @property string $question
 * @property Timestamp[]|HasMany $timestamps
 * @property Tag[]|BelongsToMany $tags
 * @property Profession $profession
 * @property Level $level
 */
class Question extends Model
{
    use HasFactory;
    use HasUuids;
    //use SoftDeletes;

    protected $fillable = ['question', 'profession_id', 'level_id',];

    /**
     * Связь вопроса с тайм-кодами (один ко многим)
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
        return $this->belongsToMany(Tag::class);
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
}
