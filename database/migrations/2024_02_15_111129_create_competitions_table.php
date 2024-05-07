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
            $table->boolean('accepted')->default(false)->nullable(false);
            $table->boolean('declined')->default(false)->nullable(false);
            $table->integer('number_of_votes_allowed')->default(1)->nullable(false);
            $table->integer('number_of_uploads')->default(3)->nullable(false);
            $table->string('company')->nullable();
            $table->timestamps();
        });
        DB::table('competitions')->insert(

            [
                [
                    'id' => 1,
                    'competition_category_id' => 5,
                    'competition_type_id' => 9,
                    'user_id' => 4,
                    'title' => 'Science and Tech Quest',
                    'by_vote' => true,
                    'path_to_photo' => '/assets/card-top.jpg',
                    'rules' => 'Investigate a scientific topic and present your findings in a comprehensive report.',
                    'prize' => 'A scholarship to a science camp',
                    'description' => 'Explore the wonders of science and technology. Join us on an adventure of discovery and innovation.',
                    'start_date' => '2023-9-3',
                    'end_date' => '2024-6-1',
                    'submission_date' => '2023-11-1',
                    'accepted' => true,

                    'number_of_votes_allowed' => 2,
                    'company' => null,
                ],
                [
                    'id' => 2,
                    'competition_category_id' => 5,
                    'competition_type_id' => 2,
                    'user_id' => 1,
                    'title' => 'Code Challenge',
                    'by_vote' => true,
                    'path_to_photo' => '/assets/competitions/CodeChallenge.png',
                    'rules' => 'Solve coding problems within a set timeframe using any programming language.',
                    'prize' => 'A coding book bundle',
                    'description' => 'Put your coding skills to the test. Dive into challenges and emerge as a coding champion!',
                    'start_date' => '2023-4-18',
                    'end_date' => '2024-9-29',
                    'submission_date' => '2024-5-11',
                    'accepted' => true,
                    'number_of_votes_allowed' => 3,
                    'company' => 'Netropolix',
                ],
                [
                    'id' => 3,
                    'competition_category_id' => 7,
                    'competition_type_id' => 7,
                    'user_id' => 1,
                    'title' => 'Cyber Security Clash',
                    'by_vote' => false,
                    'path_to_photo' => '/assets/competitions/CyberSecurityClash.webp',
                    'rules' => 'Identify and fix security vulnerabilities in a simulated network environment.',
                    'prize' => 'A subscription to a cybersecurity magazine',
                    'description' => 'Dive into the world of cybersecurity. Protect and defend against digital threats!',
                    'start_date' => '2023-4-23',
                    'end_date' => '2024-8-29',
                    'submission_date' => '2023-11-14',
                    'accepted' => true,
                    'number_of_votes_allowed' => 1,
                    'company' => 'Thomas More',
                ],
                [
                    'id' => 4,
                    'competition_category_id' => 9,
                    'competition_type_id' => 4,
                    'user_id' => 8,
                    'title' => 'Web Wizardry',
                    'by_vote' => true,
                    'path_to_photo' => '/assets/card-top.jpg',
                    'rules' => 'Design and build a responsive website with innovative features.',
                    'prize' => 'A web design masterclass ticket',
                    'description' => 'Master the art of web design. Create stunning websites that captivate audiences.',
                    'start_date' => '2023-7-7',
                    'end_date' => '2024-6-15',
                    'submission_date' => '2023-12-15',
                    'accepted' => true,
                    'number_of_votes_allowed' => 2,
                    'company' => null,
                ],
                [
                    'id' => 5,
                    'competition_category_id' => 4,
                    'competition_type_id' => 4,
                    'user_id' => 5,
                    'title' => 'Data Dive',
                    'by_vote' => true,
                    'path_to_photo' => '/assets/competitions/DataDive.jpg',
                    'rules' => 'Analyze a given dataset and present insights through data visualization.',
                    'prize' => 'A data analysis software license and a book',
                    'description' => 'Dive deep into data analytics. Uncover insights and drive informed decisions!',
                    'start_date' => '2023-6-20',
                    'end_date' => '2024-12-13',
                    'submission_date' => '2023-7-13',
                    'accepted' => true,
                    'number_of_votes_allowed' => 3,
                    'company' => null,
                ],
                [
                    'id' => 6,
                    'competition_category_id' => 3,
                    'competition_type_id' => 6,
                    'user_id' => 6,
                    'title' => 'Robo Rumble',
                    'by_vote' => false,
                    'path_to_photo' => '/assets/card-top.jpg',
                    'rules' => 'Design and build a functional robot that can complete specified tasks autonomously.',
                    'prize' => 'An advanced robotics kit',
                    'description' => 'Enter the arena of robotics. Build, program, and battle your robot against others!',
                    'start_date' => '2023-8-16',
                    'end_date' => '2024-3-13',
                    'submission_date' => '2024-1-21',
                    'accepted' => true,
                    'number_of_votes_allowed' => 1,
                    'company' => null,
                ],
                [
                    'id' => 7,
                    'competition_category_id' => 4,
                    'competition_type_id' => 2,
                    'user_id' => 4,
                    'title' => 'App Design Derby',
                    'by_vote' => true,
                    'path_to_photo' => '/assets/competitions/AppDesignDerby.png',
                    'rules' => 'Design a mobile application that addresses a specific problem or enhances user experience.',
                    'prize' => 'A feature in a popular tech magazine',
                    'description' => 'Join the race of app design. Create innovative solutions and impress the judges!',
                    'start_date' => '2023-5-15',
                    'end_date' => '2024-10-20',
                    'submission_date' => '2023-10-19',
                    'accepted' => true,
                    'number_of_votes_allowed' => 2,
                    'company' => null,
                ],
                [
                    'id' => 8,
                    'competition_category_id' => 10,
                    'competition_type_id' => 8,
                    'user_id' => 4,
                    'title' => 'Digital Dynamo',
                    'by_vote' => false,
                    'path_to_photo' => '/assets/card-top.jpg',
                    'rules' => 'Create a digital product or service that addresses a current societal issue.',
                    'prize' => 'Recognition at a prestigious tech conference',
                    'description' => 'Be the force of digital innovation. Develop solutions that shape the future!',
                    'start_date' => '2023-7-26',
                    'end_date' => '2024-3-27',
                    'submission_date' => '2023-12-28',
                    'accepted' => true,
                    'number_of_votes_allowed' => 1,
                    'company' => null,
                ],
                [
                    'id' => 9,
                    'competition_category_id' => 9,
                    'competition_type_id' => 3,
                    'user_id' => 6,
                    'title' => 'Innovate and Create',
                    'by_vote' => false,
                    'path_to_photo' => '/assets/card-top.jpg',
                    'rules' => 'Develop a new product concept and present a prototype demonstrating its functionality.',
                    'prize' => 'A patent filing for the winning innovation',
                    'description' => 'Unleash your creativity and bring groundbreaking ideas to life!',
                    'start_date' => '2023-5-21',
                    'end_date' => '2024-12-19',
                    'submission_date' => '2024-9-20',
                    'accepted' => true,
                    'number_of_votes_allowed' => 1,
                    'company' => null,
                ],
                [
                    'id' => 10,
                    'competition_category_id' => 5,
                    'competition_type_id' => 3,
                    'user_id' => 7,
                    'title' => 'Math Maelstrom',
                    'by_vote' => true,
                    'path_to_photo' => '/assets/card-top.jpg',
                    'rules' => 'Solve complex mathematical problems and present proofs of your solutions.',
                    'prize' => 'A prestigious mathematics award',
                    'description' => 'Immerse yourself in the depths of mathematical theory. Let the numbers guide you!',
                    'start_date' => '2024-8-5',
                    'end_date' => '2026-12-25',
                    'submission_date' => '2025-6-20',
                    'accepted' => true,
                    'number_of_votes_allowed' => 2,
                    'company' => null,
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
