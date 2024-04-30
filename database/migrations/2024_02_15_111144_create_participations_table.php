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
            $table->dateTime('application_date')->nullable();
            $table->dateTime('submission_date')->nullable();
            $table->timestamps();
        });
        DB::table('participations')->insert(

            [
                [
                    'id' => 1,
                    'competition_id' => 3,
                    'user_id' => 5,
                    'ranking' => 1,
                    'disqualified' => false,
                    'application_date' => '2024-04-20 09:00:00',
                    'submission_date' => '2024-04-25 12:00:00',
                ],
                [
                    'id' => 2,
                    'competition_id' => 3,
                    'user_id' => 2,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date' => '2024-01-25 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 3,
                    'competition_id' => 5,
                    'user_id' => 3,
                    'ranking' => 3,
                    'disqualified' => false,
                    'application_date' => '2023-06-18 07:00:00',
                    'submission_date' => '2024-02-13 23:58:59',
                ],
                [
                    'id' => 4,
                    'competition_id' => 3,
                    'user_id' => 1,
                    'ranking' => 4,
                    'disqualified' => false,
                    'application_date' => '2023-07-25 09:10:07',
                    'submission_date' => '2023-11-26 00:00:00',
                ],
                [
                    'id' => 5,
                    'competition_id' => 3,
                    'user_id' => 9,
                    'ranking' => 3,
                    'disqualified' => false,
                    'application_date'=> '2023-04-25 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 6,
                    'competition_id' => 3,
                    'user_id' => 3,
                    'ranking' => 0,
                    'disqualified' => false,
                    'application_date'=> '2023-06-12 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 7,
                    'competition_id' => 3,
                    'user_id' => 7,
                    'ranking' => 1,
                    'disqualified' => false,
                    'application_date'=> '2023-09-15 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 8,
                    'competition_id' => 3,
                    'user_id' => 8,
                    'ranking' => 3,
                    'disqualified' => true,
                    'application_date' => '2023-11-02 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 9,
                    'competition_id' => 3,
                    'user_id' => 2,
                    'ranking' => 1,
                    'disqualified' => false,
                    'application_date' => '2023-12-22 00:00:00',
                    'submission_date' => null,
                ],
                [
                    'id' => 10,
                    'competition_id' => 3,
                    'user_id' => 4,
                    'ranking' => 5,
                    'disqualified' => true,
                    'application_date' => '2023-08-30 00:00:00',
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
