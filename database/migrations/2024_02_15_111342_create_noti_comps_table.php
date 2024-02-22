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
        Schema::create('noti_comps', function (Blueprint $table) {
            $table->foreignId('notification_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('competition_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->integer('interval_exception')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noti_comps');
    }
};
