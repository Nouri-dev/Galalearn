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
        Schema::create('responses', function (Blueprint $table) {
            $table->integer('response_id', true);
            $table->integer('quiz_id');
            $table->integer('question_id')->index('question_id');
            $table->text('text');
            $table->boolean('is_correct');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
            $table->integer('user_id')->nullable()->index('user_id');

            $table->unique(['quiz_id', 'question_id', 'response_id'], 'quiz_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responses');
    }
};
