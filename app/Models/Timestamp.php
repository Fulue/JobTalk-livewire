<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Timestamp
 *
 * @property string $id
 * @property string $question_text
 * @property string $start_time
 * @property string $end_time
 * @property string $video_id
 * @property string $question_id
 * @property Video $video
 * @property Question $question
 */
class Timestamp extends Model
{
    use HasFactory;
    use HasUuids;
    //use SoftDeletes;

    protected $fillable = ['start_time', 'end_time', 'video_id', 'question_id','question_text'];

    /**
     * Связь тайм-кода с видео (многие к одному)
     *
     * @return BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(Video::class);
    }

    /**
     * Связь тайм-кода с вопросом (многие к одному)
     *
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
