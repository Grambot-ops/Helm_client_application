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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('surname')->nullable(false);
            $table->string('username')->nullable(false);
            $table->boolean('active')->nullable(false);
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Tarik',
                    'email' => 'nisl.maecenas@hotmail.org',
                    'password' => '$2a$12$JisyKOgS5/7ukaq6bKAoiOel5NAegyQws8jV4NoQbUpz/xA6UWp/K',
                    'surname' => 'Kirkland',
                    'username' => 'pellentesque.',
                    'active' => true,
                ],
                [
                    'id' => 2,
                    'name' => 'Dora',
                    'email' => 'fames.ac.turpis@aol.edu',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Kelley',
                    'username' => 'sed',
                    'active' => true,
                ],
                [
                    'id' => 3,
                    'name' => 'Darrel',
                    'email' => 'fusce.dolor@hotmail.net',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Zimmerman',
                    'username' => 'nisi',
                    'active' => true,
                ],
                [
                    'id' => 4,
                    'name' => 'Paul',
                    'email' => 'a.mi.fringilla@icloud.edu',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'O connor',
                    'username' => 'blandit',
                    'active' => false,
                ],
                [
                    'id' => 5,
                    'name' => 'Rhea',
                    'email' => 'non@aol.edu',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Calderon',
                    'username' => 'enim',
                    'active' => false,
                ],
                [
                    'id' => 6,
                    'name' => 'Velma',
                    'email' => 'rhoncus.nullam@hotmail.edu',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Mann',
                    'username' => 'vitae',
                    'active' => false,
                ],
                [
                    'id' => 7,
                    'name' => 'Daria',
                    'email' => 'nisl.quisque@google.com',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Mcknight',
                    'username' => 'eu',
                    'active' => true,
                ],
                [
                    'id' => 8,
                    'name' => 'Quinn',
                    'email' => 'arcu.vivamus@yahoo.org',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Allen',
                    'username' => 'felis',
                    'active' => false,
                ],
                [
                    'id' => 9,
                    'name' => 'Jael',
                    'email' => 'sapien.aenean@aol.couk',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Conley',
                    'username' => 'luctus',
                    'active' => false,
                ],
                [
                    'id' => 10,
                    'name' => 'Caesar',
                    'email' => 'nibh.quisque@aol.net',
                    'password' => '$2a$12$ojVVgiPCKjlWWtLrHpcDGOQ2vLaKQRiBNubSm/LfYkr5FAMW7Zo/e',
                    'surname' => 'Jones',
                    'username' => 'tristique',
                    'active' => true,
                ],
            ]

        );
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
