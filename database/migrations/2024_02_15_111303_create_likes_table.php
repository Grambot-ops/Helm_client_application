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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('competition_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        DB::table('likes')->insert(

            [
                ['user_id' => 1, 'competition_id' => 5],
                ['user_id' => 1, 'competition_id' => 6],
                ['user_id' => 2, 'competition_id' => 7],
                ['user_id' => 4, 'competition_id' => 7],
                ['user_id' => 6, 'competition_id' => 8],
                ['user_id' => 1, 'competition_id' => 5],
                ['user_id' => 6, 'competition_id' => 1],
                ['user_id' => 6, 'competition_id' => 6],
                ['user_id' => 6, 'competition_id' => 7],
                ['user_id' => 9, 'competition_id' => 6],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
