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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable(false);
            $table->text('description')->nullable(false);
            $table->integer('interval_default')->nullable(false);
            $table->timestamps();
        });
        DB::table('notifications')->insert(

            [
                ['id' => 1, 'title' => 'Begin Competition', 'description' => 'Get ready to unleash your talents, ignite your passions and embark on a thrilling journey of competition! We are thrilled to announce the commencement of our much-anticipated competition!!!', 'interval_default' => 1],
                ['id' => 2, 'title' => 'Deadline Warning', 'description' => "We hope this message finds you well and we are filled with excitement to see all of your submissions. As the competition heats up, we're reaching out with an important deadline reminder.", 'interval_default' => 3],
                ['id' => 3, 'title' => 'End competition', 'description' => "With great excitement and a sense of accomplishment, we are thrilled to announce the conclusion of our competition! This marks the end of an incredible journey filled with creativity, innovation and passion from talented individuals like you.", 'interval_default' => 10],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
