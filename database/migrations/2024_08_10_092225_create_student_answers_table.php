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
        Schema::create('student_answers', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->integer('question_id');
            $table->integer('response_id');
            $table->dateTime('created_at')->useCurrent();

            $table->primary(['user_id', 'quiz_id', 'question_id', 'response_id']);
            $table->index(['quiz_id', 'question_id', 'response_id'], 'quiz_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_answers');
    }
};
