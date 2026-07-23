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
        Schema::create('results', function (Blueprint $table) {
            $table->integer('quiz_id');
            $table->integer('user_id')->index('user_id');
            $table->integer('score');
            $table->dateTime('date_completed')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();

            $table->primary(['quiz_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
