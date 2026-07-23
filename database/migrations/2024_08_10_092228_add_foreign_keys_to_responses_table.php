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
        Schema::table('responses', function (Blueprint $table) {
            $table->foreign(['quiz_id'], 'responses_ibfk_1')->references(['quiz_id'])->on('questions')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['question_id'], 'responses_ibfk_2')->references(['question_id'])->on('questions')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'responses_ibfk_3')->references(['user_id'])->on('instructors')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('responses', function (Blueprint $table) {
            $table->dropForeign('responses_ibfk_1');
            $table->dropForeign('responses_ibfk_2');
            $table->dropForeign('responses_ibfk_3');
        });
    }
};
