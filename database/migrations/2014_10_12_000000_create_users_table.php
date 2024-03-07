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
        $data = [
            ['id' => 1, 'name' => 'Tarik', 'email' => 'nisl.maecenas@hotmail.org', 'password' => Hash::make('password1'), 'surname' => 'Kirkland', 'username' => 'pellentesque.', 'active' => true],
            ['id' => 2, 'name' => 'Dora', 'email' => 'fames.ac.turpis@aol.edu', 'password' => Hash::make('password2'), 'surname' => 'Kelley', 'username' => 'sed', 'active' => true],
            ['id' => 3, 'name' => 'Darrel', 'email' => 'fusce.dolor@hotmail.net', 'password' => Hash::make('password3'), 'surname' => 'Zimmerman', 'username' => 'nisi', 'active' => true],
            // Add more data as needed
        ];

        foreach ($data as $row) {
            DB::table('users')->insert($row);
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
