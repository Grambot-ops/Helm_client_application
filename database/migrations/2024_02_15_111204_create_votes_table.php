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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('submission_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        DB::table('votes')->insert(

            [
                ['submission_id' => 12, 'user_id' => 7],
                ['submission_id' => 15, 'user_id' => 2],
                ['submission_id' => 18, 'user_id' => 20],
                ['submission_id' => 24, 'user_id' => 15],
                ['submission_id' => 11, 'user_id' => 9],
                ['submission_id' => 22, 'user_id' => 3],
                ['submission_id' => 14, 'user_id' => 18],
                ['submission_id' => 23, 'user_id' => 6],
                ['submission_id' => 23, 'user_id' => 11],
                ['submission_id' => 23, 'user_id' => 13],
                ['submission_id' => 17, 'user_id' => 8],
                ['submission_id' => 21, 'user_id' => 5],
                ['submission_id' => 13, 'user_id' => 19],
                ['submission_id' => 16, 'user_id' => 4],
                ['submission_id' => 25, 'user_id' => 10],
                ['submission_id' => 19, 'user_id' => 1],
                ['submission_id' => 13, 'user_id' => 14],
                ['submission_id' => 15, 'user_id' => 17],
                ['submission_id' => 20, 'user_id' => 12],
                ['submission_id' => 12, 'user_id' => 16],
                ['submission_id' => 12, 'user_id' => 21],
                ['submission_id' => 23, 'user_id' => 7],
                ['submission_id' => 22, 'user_id' => 2],
                ['submission_id' => 21, 'user_id' => 20],
                ['submission_id' => 21, 'user_id' => 15],
                ['submission_id' => 22, 'user_id' => 9],
                ['submission_id' => 13, 'user_id' => 3],
                ['submission_id' => 19, 'user_id' => 18],
                ['submission_id' => 11, 'user_id' => 6],
                ['submission_id' => 24, 'user_id' => 11],

            ]
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
