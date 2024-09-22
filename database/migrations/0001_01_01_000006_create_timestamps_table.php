<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('timestamps', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->text('question_text'); // Текст вопроса

            $table->time('start_time'); // Время начала
            $table->time('end_time'); // Время конца

            $table->foreignUuid('video_id')->constrained()->onDelete('cascade');
            $table->foreignUuid('question_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timestamps');
    }
};
