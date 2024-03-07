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
                ['id' => 1, 'name' => 'Mauris'],
                ['id' => 2, 'name' => 'ac'],
                ['id' => 3, 'name' => 'nibh'],
                ['id' => 4, 'name' => 'dui,'],
                ['id' => 5, 'name' => 'justo.'],
                ['id' => 6, 'name' => 'porttitor'],
                ['id' => 7, 'name' => 'euismod'],
                ['id' => 8, 'name' => 'sagittis'],
                ['id' => 9, 'name' => 'dolor.'],
                ['id' => 10, 'name' => 'Pellentesque'],

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
