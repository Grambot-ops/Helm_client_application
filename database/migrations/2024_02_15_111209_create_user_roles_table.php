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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
        DB::table('user_roles')->insert(

            [
                ['role_id' => 1, 'user_id' => 1],
                ['role_id' => 2, 'user_id' => 1],
                ['role_id' => 1, 'user_id' => 3],
                ['role_id' => 2, 'user_id' => 3],
                ['role_id' => 2, 'user_id' => 2],
                ['role_id' => 2, 'user_id' => 4],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
