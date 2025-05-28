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
        Schema::create('changelogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->nullable(false);
            $table->foreignId('competition_id')->constrained()->nullable(false);
            $table->dateTime('date_change');
            $table->timestamps();
        });
        DB::table('changelogs')->insert(

            [
                ['id' => 1, 'user_id' => 7, 'competition_id' => 9, 'date_change' => '2023-8-19'],
                ['id' => 2, 'user_id' => 2, 'competition_id' => 6, 'date_change' => '2023-10-16'],
                ['id' => 3, 'user_id' => 6, 'competition_id' => 7, 'date_change' => '2024-12-15'],
                ['id' => 4, 'user_id' => 4, 'competition_id' => 6, 'date_change' => '2023-12-9'],
                ['id' => 5, 'user_id' => 3, 'competition_id' => 6, 'date_change' => '2024-9-6'],
                ['id' => 6, 'user_id' => 2, 'competition_id' => 3, 'date_change' => '2024-4-13'],
                ['id' => 7, 'user_id' => 7, 'competition_id' => 3, 'date_change' => '2023-12-27'],
                ['id' => 8, 'user_id' => 5, 'competition_id' => 4, 'date_change' => '2024-8-12'],
                ['id' => 9, 'user_id' => 8, 'competition_id' => 4, 'date_change' => '2023-11-15'],
                ['id' => 10, 'user_id' => 1, 'competition_id' => 8, 'date_change' => '2024-7-29'],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('changelogs');
    }
};
