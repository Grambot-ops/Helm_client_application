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
        Schema::create('competition_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->timestamps();
        });
        DB::table('competition_categories')->insert(

            [
                ['id' => 1, 'name' => 'lectus'],
                ['id' => 2, 'name' => 'fermentum'],
                ['id' => 3, 'name' => 'nulla'],
                ['id' => 4, 'name' => 'Etiam'],
                ['id' => 5, 'name' => 'ligula'],
                ['id' => 6, 'name' => 'dapibus'],
                ['id' => 7, 'name' => 'et'],
                ['id' => 8, 'name' => 'purus'],
                ['id' => 9, 'name' => 'Donec'],
                ['id' => 10, 'name' => 'lectus'],
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_categories');
    }
};
