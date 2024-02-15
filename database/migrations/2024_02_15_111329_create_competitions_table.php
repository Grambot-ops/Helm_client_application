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
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_category_id')->nullable();
            $table->foreignId('category_type_id')->nullable(false);
            /* Organizer */
            $table->foreignId('user_id')->nullable(false);
            $table->string('title')->nullable(false);
            $table->boolean('by_vote')->nullable(false);
            $table->string('path_to_string')->nullable();
            $table->text('rules')->nullable();
            $table->text('prize')->nullable();
            $table->text('description')->nullable(false);
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
            $table->dateTime('submission_date')->nullable(false);
            $table->boolean('accepted')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
