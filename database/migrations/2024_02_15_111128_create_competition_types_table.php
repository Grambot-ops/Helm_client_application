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
        Schema::create('competition_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->timestamps();
        });

        DB::table('competition_types')->insert(

            [
                ['id' => 1, 'name' => 'Podcast'],
                ['id' => 2, 'name' => 'Link'],
                ['id' => 3, 'name' => 'Code'],
                ['id' => 4, 'name' => 'Video'],
                ['id' => 5, 'name' => 'Photo'],
                ['id' => 6, 'name' => 'Text'],
                ['id' => 7, 'name' => 'Recipe'],
                ['id' => 8, 'name' => 'Quote'],
                ['id' => 9, 'name' => 'Essay'],
                ['id' => 10, 'name' => 'Quiz'],
                ['id' => 11, 'name' => 'YouTube link'],
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_types');
    }
};
