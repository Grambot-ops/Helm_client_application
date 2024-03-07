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
        Schema::create('participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('ranking')->nullable(false);
            $table->boolean('disqualified')->nullable(false);
            $table->timestamps();
        });
        DB::table('participations')->insert(

            [
                ['competition_id' => 6, 'user_id' => 5, 'ranking' => 1, 'disqualified' => true],
                ['competition_id' => 8, 'user_id' => 3, 'ranking' => 0, 'disqualified' => false],
                ['competition_id' => 7, 'user_id' => 3, 'ranking' => 3, 'disqualified' => true],
                ['competition_id' => 5, 'user_id' => 1, 'ranking' => 4, 'disqualified' => true],
                ['competition_id' => 9, 'user_id' => 9, 'ranking' => 3, 'disqualified' => false],
                ['competition_id' => 4, 'user_id' => 3, 'ranking' => 0, 'disqualified' => false],
                ['competition_id' => 3, 'user_id' => 7, 'ranking' => 1, 'disqualified' => true],
                ['competition_id' => 4, 'user_id' => 8, 'ranking' => 3, 'disqualified' => true],
                ['competition_id' => 9, 'user_id' => 2, 'ranking' => 1, 'disqualified' => false],
                ['competition_id' => 8, 'user_id' => 4, 'ranking' => 5, 'disqualified' => true],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participations');
    }
};
