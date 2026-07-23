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
        Schema::table('results', function (Blueprint $table) {
            $table->foreign(['quiz_id'], 'results_ibfk_1')->references(['quiz_id'])->on('quizzes')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'results_ibfk_2')->references(['user_id'])->on('students')->onUpdate('no action')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign('results_ibfk_1');
            $table->dropForeign('results_ibfk_2');
        });
    }
};
