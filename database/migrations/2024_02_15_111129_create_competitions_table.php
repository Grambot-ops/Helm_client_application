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
            $table->foreignId('competition_category_id')->nullable()->constrained();
            $table->foreignId('competition_type_id')->nullable(false)->constrained();
            /* Organizer */
            $table->foreignId('user_id')->nullable(false)->constrained();
            $table->string('title')->nullable(false);
            $table->boolean('by_vote')->nullable(false);
            $table->string('path_to_photo')->nullable();
            $table->text('rules')->nullable();
            $table->text('prize')->nullable();
            $table->text('description')->nullable(false);
            $table->dateTime('start_date')->nullable(false);
            $table->dateTime('end_date')->nullable(false);
            $table->dateTime('submission_date')->nullable(false);
            $table->boolean('accepted')->nullable(false);
            $table->timestamps();
        });
        DB::table('competitions')->insert(

            [
                [
                    'id' => 1,
                    'competition_category_id' => 5,
                    'competition_type_id' => 9,
                    'user_id' => 4,
                    'title' => 'lacus. Mauris non',
                    'by_vote' => true,
                    'path_to_photo' => 'https://reddit.com/sub/cars',
                    'rules' => 'nec, diam. Duis mi enim, condimentum eget, volutpat ornare, facilisis',
                    'prize' => 'nibh dolor,',
                    'description' => 'nec metus facilisis lorem tristique aliquet. Phasellus fermentum',
                    'start_date' => '2023-11-3',
                    'end_date' => '2024-6-1',
                    'submission_date' => '2023-9-1',
                    'accepted' => false,
                ],
                [
                    'id' => 2,
                    'competition_category_id' => 5,
                    'competition_type_id' => 2,
                    'user_id' => 6,
                    'title' => 'semper egestas, urna',
                    'by_vote' => true,
                    'path_to_photo' => 'https://yahoo.com/sub/cars',
                    'rules' => 'dolor. Fusce feugiat. Lorem ipsum dolor sit amet, consectetuer adipiscing',
                    'prize' => 'tincidunt dui',
                    'description' => 'interdum',
                    'start_date' => '2023-4-18',
                    'end_date' => '2024-5-29',
                    'submission_date' => '2024-9-11',
                    'accepted' => true,
                ],
                [
                    'id' => 3,
                    'competition_category_id' => 7,
                    'competition_type_id' => 7,
                    'user_id' => 9,
                    'title' => 'sem, consequat nec,',
                    'by_vote' => false,
                    'path_to_photo' => 'https://nytimes.com/settings',
                    'rules' => 'in faucibus orci luctus et ultrices posuere cubilia Curae Phasellus',
                    'prize' => 'tincidunt. Donec',
                    'description' => 'ullamcorper. Duis cursus, diam at pretium',
                    'start_date' => '2023-4-23',
                    'end_date' => '2024-4-29',
                    'submission_date' => '2023-11-14',
                    'accepted' => true,
                ],
                [
                    'id' => 4,
                    'competition_category_id' => 9,
                    'competition_type_id' => 4,
                    'user_id' => 8,
                    'title' => 'Nullam velit dui,',
                    'by_vote' => true,
                    'path_to_photo' => 'https://naver.com/sub/cars',
                    'rules' => 'consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia',
                    'prize' => 'rhoncus. Donec',
                    'description' => 'a, facilisis non, bibendum sed, est.',
                    'start_date' => '2023-7-7',
                    'end_date' => '2024-6-15',
                    'submission_date' => '2023-7-15',
                    'accepted' => false,
                ],
                [
                    'id' => 5,
                    'competition_category_id' => 4,
                    'competition_type_id' => 4,
                    'user_id' => 5,
                    'title' => 'Nunc pulvinar arcu',
                    'by_vote' => false,
                    'path_to_photo' => 'https://cnn.com/fr',
                    'rules' => 'eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer in',
                    'prize' => 'rutrum, justo.',
                    'description' => 'turpis vitae purus gravida sagittis. Duis gravida. Praesent eu',
                    'start_date' => '2023-6-20',
                    'end_date' => '2024-12-13',
                    'submission_date' => '2023-7-13',
                    'accepted' => false,
                ],
                [
                    'id' => 6,
                    'competition_category_id' => 3,
                    'competition_type_id' => 6,
                    'user_id' => 6,
                    'title' => 'et magnis dis',
                    'by_vote' => true,
                    'path_to_photo' => 'https://pinterest.com/sub',
                    'rules' => 'elit sed consequat auctor, nunc nulla vulputate dui, nec tempus',
                    'prize' => 'arcu ac',
                    'description' => 'quam.',
                    'start_date' => '2023-8-16',
                    'end_date' => '2024-11-30',
                    'submission_date' => '2024-8-21',
                    'accepted' => true,
                ],
                [
                    'id' => 7,
                    'competition_category_id' => 4,
                    'competition_type_id' => 2,
                    'user_id' => 4,
                    'title' => 'Vivamus nibh dolor,',
                    'by_vote' => false,
                    'path_to_photo' => 'https://youtube.com/group/9',
                    'rules' => 'ut aliquam iaculis, lacus pede sagittis augue, eu tempor erat',
                    'prize' => 'sodales elit',
                    'description' => 'cursus vestibulum. Mauris magna.',
                    'start_date' => '2023-10-15',
                    'end_date' => '2024-10-20',
                    'submission_date' => '2023-5-19',
                    'accepted' => false,
                ],
                [
                    'id' => 8,
                    'competition_category_id' => 10,
                    'competition_type_id' => 8,
                    'user_id' => 4,
                    'title' => 'Fusce aliquet magna',
                    'by_vote' => false,
                    'path_to_photo' => 'http://reddit.com/settings',
                    'rules' => 'orci. Ut semper pretium neque. Morbi quis urna. Nunc quis',
                    'prize' => 'tortor. Integer',
                    'description' => 'elit. Etiam',
                    'start_date' => '2023-12-26',
                    'end_date' => '2024-3-27',
                    'submission_date' => '2024-7-28',
                    'accepted' => false,
                ],
                [
                    'id' => 9,
                    'competition_category_id' => 9,
                    'competition_type_id' => 3,
                    'user_id' => 6,
                    'title' => 'odio. Phasellus at',
                    'by_vote' => true,
                    'path_to_photo' => 'http://facebook.com/sub/cars',
                    'rules' => 'sapien imperdiet ornare. In faucibus. Morbi vehicula. Pellentesque tincidunt tempus',
                    'prize' => 'nostra, per',
                    'description' => 'porttitor interdum. Sed auctor odio a',
                    'start_date' => '2023-5-21',
                    'end_date' => '2024-12-19',
                    'submission_date' => '2024-9-20',
                    'accepted' => true,
                ],
                [
                    'id' => 10,
                    'competition_category_id' => 5,
                    'competition_type_id' => 3,
                    'user_id' => 7,
                    'title' => 'turpis egestas. Fusce',
                    'by_vote' => false,
                    'path_to_photo' => 'https://netflix.com/group/9',
                    'rules' => 'ac nulla. In tincidunt congue turpis. In condimentum. Donec at',
                    'prize' => 'blandit enim',
                    'description' => 'egestas a, scelerisque sed,',
                    'start_date' => '2023-5-5',
                    'end_date' => '2024-6-25',
                    'submission_date' => '2024-12-20',
                    'accepted' => true,
                ],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competitions');
    }
};
