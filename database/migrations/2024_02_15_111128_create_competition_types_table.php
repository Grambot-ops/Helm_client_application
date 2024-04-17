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
            // whether the submission type is a file or text like a link
            $table->boolean('is_file')->nullable(false);
            $table->timestamps();
        });

        DB::table('competition_types')->insert(

            [
                ['id' => 1, 'name' => 'Podcast', 'is_file' => true],
                ['id' => 2, 'name' => 'Link', 'is_file' => false],
                ['id' => 3, 'name' => 'Code', 'is_file' => true],
                ['id' => 4, 'name' => 'Video', 'is_file' => true],
                ['id' => 5, 'name' => 'Photo', 'is_file' =>  true],
                ['id' => 6, 'name' => 'Text', 'is_file' => false],
                ['id' => 7, 'name' => 'Recipe', 'is_file' => false],
                ['id' => 8, 'name' => 'Quote', 'is_file' => false],
                ['id' => 9, 'name' => 'Essay', 'is_file' => false],
                ['id' => 10, 'name' => 'Quiz', 'is_file' => false],
                ['id' => 11, 'name' => 'YouTube link', 'is_file' => false],
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
