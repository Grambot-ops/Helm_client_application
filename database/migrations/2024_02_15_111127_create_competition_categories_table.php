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
                ['id' => 1, 'name' => 'IT Factory'],
                ['id' => 2, 'name' => 'Orthopedics'],
                ['id' => 3, 'name' => 'Chemistry'],
                ['id' => 4, 'name' => 'Biology'],
                ['id' => 5, 'name' => 'Mathematics'],
                ['id' => 6, 'name' => 'Business'],
                ['id' => 7, 'name' => 'Midwife'],
                ['id' => 8, 'name' => 'Photography'],
                ['id' => 9, 'name' => 'Game Development'],
                ['id' => 10, 'name' => 'Physics'],
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
