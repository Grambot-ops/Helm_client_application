<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->text('interval_before_date')->nullable(false);
            $table->timestamps();
        });
        DB::table('notifications')->insert([
            [
                'id' => 1,
                'title' => 'Begin Competition',
                'description' => 'Get ready to unleash your talents, ignite your passions and embark on a thrilling journey of competition! We are thrilled to announce the commencement of our much-anticipated competition!!!',
                'interval_default' => 1,
                'interval_before_date' => 'begin'
            ],
            [
                'id' => 2,
                'title' => 'Deadline Warning',
                'description' => "We hope this message finds you well and we are filled with excitement to see all of your submissions. As the competition heats up, we're reaching out with an important deadline reminder.",
                'interval_default' => 3,
                'interval_before_date' => 'submission'
            ],
            [
                'id' => 3,
                'title' => 'End competition',
                'description' => "With great excitement and a sense of accomplishment, we are thrilled to announce the conclusion of our competition! This marks the end of an incredible journey filled with creativity, innovation and passion from talented individuals like you.",
                'interval_default' => 10,
                'interval_before_date' => 'end'
            ],
            [
                'id' => 4,
                'title' => 'New Feature Added',
                'description' => 'Exciting news! We have just added a new feature to our platform. Check it out now and let us know what you think!',
                'interval_default' => 7,
                'interval_before_date' => 'submission'
            ],
            [
                'id' => 5,
                'title' => 'Important Announcement',
                'description' => 'Attention all users! We have an important announcement regarding upcoming maintenance. Please stay tuned for further details.',
                'interval_default' => 2,
                'interval_before_date' => 'submission'
            ],
            [
                'id' => 6,
                'title' => 'Product Launch Event',
                'description' => 'Join us for the grand unveiling of our latest product! Be the first to experience its innovative features and functionalities.',
                'interval_default' => 5,
                'interval_before_date' => 'submission'
            ],
            [
                'id' => 7,
                'title' => 'Holiday Closure',
                'description' => 'Please be advised that our offices will be closed for the upcoming holiday. We will resume normal operations on [date]. Wishing you a joyful holiday season!',
                'interval_default' => 14,
                'interval_before_date' => 'submission'
            ]
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
