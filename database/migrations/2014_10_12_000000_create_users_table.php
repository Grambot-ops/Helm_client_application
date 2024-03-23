<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

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
            $table->boolean('active')->nullable(false)->default(true);
            $table->boolean('admin')->nullable(false)->default(false);
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            [
                [
                    'id' => 1,
                    'name' => 'Root',
                    'email' => 'admin@vcoa.tmcplatform.be',
                    'password' => Hash::make('admin'),
                    'surname' => 'Admin',
                    'username' => 'admin',
                    'active' => true,
                    'admin' => true,
                ],
                [
                    'id' => 2,
                    'name' => 'Dora',
                    'email' => 'fames.ac.turpis@aol.edu',
                    'password' => Hash::make('password2'),
                    'surname' => 'Kelley',
                    'username' => 'sed',
                    'active' => true,
                    'admin' => false,
                ],
                [
                    'id' => 3,
                    'name' => 'Darrel',
                    'email' => 'fusce.dolor@hotmail.net',
                    'password' => Hash::make('password3'),
                    'surname' => 'Zimmerman',
                    'username' => 'nisi',
                    'active' => true,
                    'admin' => false,
                ],
                [
                    'id' => 4,
                    'name' => 'Paul',
                    'email' => 'a.mi.fringilla@icloud.edu',
                    'password' => Hash::make('password4'),
                    'surname' => 'O connor',
                    'username' => 'blandit',
                    'active' => false,
                    'admin' => false,
                ],
                [
                    'id' => 5,
                    'name' => 'Rhea',
                    'email' => 'non@aol.edu',
                    'password' => Hash::make('password5'),
                    'surname' => 'Calderon',
                    'username' => 'enim',
                    'active' => false,
                    'admin' => false,
                ],
                [
                    'id' => 6,
                    'name' => 'Velma',
                    'email' => 'rhoncus.nullam@hotmail.edu',
                    'password' => Hash::make('password6'),
                    'surname' => 'Mann',
                    'username' => 'vitae',
                    'active' => false,
                    'admin' => false,
                ],
                [
                    'id' => 7,
                    'name' => 'Daria',
                    'email' => 'nisl.quisque@google.com',
                    'password' => Hash::make('password7'),
                    'surname' => 'Mcknight',
                    'username' => 'eu',
                    'active' => true,
                    'admin' => false,
                ],
                [
                    'id' => 8,
                    'name' => 'Quinn',
                    'email' => 'arcu.vivamus@yahoo.org',
                    'password' => Hash::make('password8'),
                    'surname' => 'Allen',
                    'username' => 'felis',
                    'active' => false,
                    'admin' => false,
                ],
                [
                    'id' => 9,
                    'name' => 'Jael',
                    'email' => 'sapien.aenean@aol.couk',
                    'password' => Hash::make('password9'),
                    'surname' => 'Conley',
                    'username' => 'luctus',
                    'active' => false,
                    'admin' => false,
                ],
                [
                    'id' => 10,
                    'name' => 'Caesar',
                    'email' => 'nibh.quisque@aol.net',
                    'password' => Hash::make('password10'),
                    'surname' => 'Jones',
                    'username' => 'tristique',
                    'active' => true,
                    'admin' => false,
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
