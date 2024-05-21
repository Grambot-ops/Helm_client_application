<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->dateTime('application_date')->default(now())->nullable();
            $table->dateTime('submission_date')->nullable();
            $table->timestamps();
        });
        DB::table('participations')->insert(

            [
                [
                    'id' => 1,
                    'competition_id' => 3,
                    'user_id' => 5,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-04-20 00:00:00',
                    'submission_date' => '2023-10-25 00:00:00',
                ],
                [
                    'id' => 2,
                    'competition_id' => 3,
                    'user_id' => 2,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-01-25 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 3,
                    'competition_id' => 3,
                    'user_id' => 3,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-03-18 00:00:00',
                    'submission_date' => '2023-09-13 00:00:00',
                ],
                [
                    'id' => 4,
                    'competition_id' => 3,
                    'user_id' => 1,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-02-25 00:00:00',
                    'submission_date' => '2023-08-26 00:00:00',
                ],
                [
                    'id' => 5,
                    'competition_id' => 5,
                    'user_id' => 9,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date'=> '2023-02-02 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 6,
                    'competition_id' => 5,
                    'user_id' => 3,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date'=> '2023-06-12 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 7,
                    'competition_id' => 5,
                    'user_id' => 7,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date'=> '2023-05-15 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 8,
                    'competition_id' => 3,
                    'user_id' => 8,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-07-02 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 9,
                    'competition_id' => 3,
                    'user_id' => 2,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-12-22 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 10,
                    'competition_id' => 5,
                    'user_id' => 4,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 11,
                    'competition_id' => 1,
                    'user_id' => 4,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 12,
                    'competition_id' => 1,
                    'user_id' => 5,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 13,
                    'competition_id' => 1,
                    'user_id' => 6,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 14,
                    'competition_id' => 1,
                    'user_id' => 7,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 15,
                    'competition_id' => 2,
                    'user_id' => 4,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 16,
                    'competition_id' => 2,
                    'user_id' => 5,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 17,
                    'competition_id' => 2,
                    'user_id' => 6,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 18,
                    'competition_id' => 2,
                    'user_id' => 7,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 19,
                    'competition_id' => 4,
                    'user_id' => 6,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 20,
                    'competition_id' => 4,
                    'user_id' => 7,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 21,
                    'competition_id' => 4,
                    'user_id' => 8,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 22,
                    'competition_id' => 4,
                    'user_id' => 9,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 23,
                    'competition_id' => 10,
                    'user_id' => 6,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 24,
                    'competition_id' => 10,
                    'user_id' => 7,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 25,
                    'competition_id' => 10,
                    'user_id' => 8,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 26,
                    'competition_id' => 10,
                    'user_id' => 9,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2023-05-30 00:00:00',
                    'submission_date' => null,
                ],
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
