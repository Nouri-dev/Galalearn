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
        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign(['category_id'], 'blogs_ibfk_1')->references(['category_id'])->on('categories')->onUpdate('no action')->onDelete('cascade');
            $table->foreign(['user_id'], 'blogs_ibfk_2')->references(['user_id'])->on('instructors')->onUpdate('no action')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign('blogs_ibfk_1');
            $table->dropForeign('blogs_ibfk_2');
        });
    }
};
