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
        Schema::table('student_answers', function (Blueprint $table) {
            $table->foreign(['user_id'], 'student_answers_ibfk_1')->references(['user_id'])->on('students')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['quiz_id', 'question_id', 'response_id'], 'student_answers_ibfk_2')->references(['quiz_id', 'question_id', 'response_id'])->on('responses')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_answers', function (Blueprint $table) {
            $table->dropForeign('student_answers_ibfk_1');
            $table->dropForeign('student_answers_ibfk_2');
        });
    }
};
