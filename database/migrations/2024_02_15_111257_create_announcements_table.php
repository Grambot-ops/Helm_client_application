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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(false)->constrained();
            $table->text('message');
            $table->timestamps();
        });
        DB::table('announcements')->insert(

            [
                ['id' => 1, 'user_id' => 4, 'message' => 'You have been kicked'],
                ['id' => 2, 'user_id' => 5, 'message' => 'You have won the competition'],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
