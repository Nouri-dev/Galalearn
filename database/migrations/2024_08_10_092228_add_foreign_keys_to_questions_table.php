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
        Schema::table('questions', function (Blueprint $table) {
            $table->foreign(['quiz_id'], 'questions_ibfk_1')->references(['quiz_id'])->on('quizzes')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'questions_ibfk_2')->references(['user_id'])->on('instructors')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign('questions_ibfk_1');
            $table->dropForeign('questions_ibfk_2');
        });
    }
};
