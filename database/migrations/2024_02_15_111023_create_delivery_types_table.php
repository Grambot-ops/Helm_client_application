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
        Schema::create('delivery_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->timestamps();
        });
        DB::table('delivery_types')->insert(

            [
                ['id' => 1, 'name' => 'email'],
                ['id' => 2, 'name' => 'phone'],
                ['id' => 3, 'name' => 'photo'],
                ['id' => 4, 'name' => 'link'],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_types');
    }
};
