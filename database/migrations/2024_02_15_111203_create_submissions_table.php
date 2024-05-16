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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            /* TODO: add DTR */
            $table->foreignId('participation_id')->nullable(false)->constrained();
            $table->string('title')->nullable(false)->default("This submission has no name");
            $table->string('path')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        DB::table('submissions')->insert(

            [
                ['id' => 1, 'title' => 'Securing The Throne', 'participation_id' => 9, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'https://zoom.us/sub/cars', 'description' => 'Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed'],
                ['id' => 2, 'title' => 'Battle of the bytes', 'participation_id' => 9, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'http://facebook.com/en-us', 'description' => 'Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo'],
                ['id' => 3, 'title' => 'Shield up', 'participation_id' => 8, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'http://youtube.com/en-ca', 'description' => 'Proin mi. Aliquam gravida mauris ut mi. Duis risus odio,'],
                ['id' => 4, 'title' => 'Hackers beware', 'participation_id' => 2, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'http://guardian.co.uk/en-us', 'description' => 'rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar'],
                ['id' => 5, 'title' => 'Armor up' , 'participation_id' => 4, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'https://pinterest.com/en-us', 'description' => 'vulputate, nisi sem semper erat, in consectetuer ipsum nunc id'],
                ['id' => 6, 'title' => 'Digital warfare', 'participation_id' => 9, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'http://cnn.com/group/9', 'description' => 'magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur'],
                ['id' => 7, 'title' => 'Lock and load', 'participation_id' => 6, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'https://pinterest.com/sub/cars', 'description' => 'Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat,'],
                ['id' => 8, 'title' => 'Cyber champions', 'participation_id' => 2, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'http://whatsapp.com/settings', 'description' => 'Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet'],
                ['id' => 9, 'title' => 'Byte by byte', 'participation_id' => 2, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'https://netflix.com/settings', 'description' => 'venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at,'],
                ['id' => 10, 'title' => 'Defend the data','participation_id' => 6, 'path' => '/assets/competitions/AppDesignDerby.png', 'link' => 'http://cnn.com/group/9', 'description' => 'nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio.'],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
