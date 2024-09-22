<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Level
 *
 * @property string $id
 * @property string $level
 * @property string $icon
 * @property string $profession_id
 * @property-read Video[]|HasMany $videos
 * @property-read Question[]|HasMany $questions
 */
class Level extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $fillable = ['level', 'icon', 'profession_id'];

    /**
     * Связь уровня с видео (один ко многим)
     *
     * @return HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    /**
     * Связь уровня с вопросами (один ко многим)
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
