<?php

use App\Models\User;
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
            $table->string('profile_photo_path', 2048)->default('/assets/profile_pictures/default.jpg');
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
                    'admin' => true,
                ],
                [
                    'id' => 2,
                    'name' => 'Regular',
                    'email' => 'user@vcoa.tmcplatform.be',
                    'password' => Hash::make('password'),
                    'surname' => 'User',
                    'username' => 'user',
                    'admin' => false,
                ]
            ]
        );

        for($i = 0; $i < 20; $i++)
        {
            User::factory()->create();
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
