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
            // A comma separated string that contains the accepted file types
            // that looks something like:
            //
            // video,audio,document
            //
            // The order of the words does not matter.
            $table->string('filetypes')->nullable();
            $table->timestamps();
        });

        DB::table('competition_types')->insert(

            [
                ['id' => 1, 'name' => 'Podcast', 'is_file' => true, 'filetypes' => 'audio,video'],
                ['id' => 2, 'name' => 'Link', 'is_file' => false, 'filetypes' => null],
                ['id' => 3, 'name' => 'Code', 'is_file' => false, 'filetypes' => null],
                ['id' => 4, 'name' => 'Video', 'is_file' => true, 'filetypes' => 'video'],
                ['id' => 5, 'name' => 'Photo', 'is_file' =>  true, 'filetypes' => 'image'],
                ['id' => 6, 'name' => 'Text', 'is_file' => false, 'filetypes' => null],
                ['id' => 7, 'name' => 'Recipe', 'is_file' => true, 'filetypes' => 'document'],
                ['id' => 8, 'name' => 'Quote', 'is_file' => false, 'filetypes' => null],
                ['id' => 9, 'name' => 'Essay', 'is_file' => false, 'filetypes' => null],
                ['id' => 10, 'name' => 'Quiz', 'is_file' => false, 'filetypes' => null],
                ['id' => 11, 'name' => 'YouTube link', 'is_file' => false, 'filetypes' => false],
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
