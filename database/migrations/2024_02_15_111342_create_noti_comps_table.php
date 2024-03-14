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
            $table->id();
            $table->foreignId('notification_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('competition_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->integer('interval_exception')->nullable();
            $table->timestamps();
        });
        DB::table('noti_comps')->insert(

            [
                ['notification_id' => 7, 'competition_id' => 8, 'interval_exception' => 6],
                ['notification_id' => 6, 'competition_id' => 1, 'interval_exception' => 7],
                ['notification_id' => 2, 'competition_id' => 5, 'interval_exception' => 1],
                ['notification_id' => 3, 'competition_id' => 5, 'interval_exception' => 4],
                ['notification_id' => 5, 'competition_id' => 9, 'interval_exception' => 5],
                ['notification_id' => 2, 'competition_id' => 9, 'interval_exception' => 8],
                ['notification_id' => 6, 'competition_id' => 6, 'interval_exception' => 6],
                ['notification_id' => 5, 'competition_id' => 3, 'interval_exception' => 3],
                ['notification_id' => 6, 'competition_id' => 8, 'interval_exception' => 8],
                ['notification_id' => 7, 'competition_id' => 1, 'interval_exception' => 7],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noti_comps');
    }
};
