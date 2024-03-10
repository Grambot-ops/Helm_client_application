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
            $table->foreignId('delivery_type_id')->nullable(false)->constrained();
            $table->foreignId('participation_id')->nullable(false)->constrained();
            $table->string('path')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        DB::table('submissions')->insert(

            [
                ['id' => 1, 'delivery_type_id' => 1, 'participation_id' => 9, 'path' => 'http://facebook.com/one', 'link' => 'https://zoom.us/sub/cars', 'description' => 'Sed dictum. Proin eget odio. Aliquam vulputate ullamcorper magna. Sed'],
                ['id' => 2, 'delivery_type_id' => 1, 'participation_id' => 9, 'path' => 'https://whatsapp.com/one', 'link' => 'http://facebook.com/en-us', 'description' => 'Integer id magna et ipsum cursus vestibulum. Mauris magna. Duis dignissim tempor arcu. Vestibulum ut eros non enim commodo'],
                ['id' => 3, 'delivery_type_id' => 1, 'participation_id' => 8, 'path' => 'http://walmart.com/fr', 'link' => 'http://youtube.com/en-ca', 'description' => 'Proin mi. Aliquam gravida mauris ut mi. Duis risus odio,'],
                ['id' => 4, 'delivery_type_id' => 2, 'participation_id' => 2, 'path' => 'https://twitter.com/en-ca', 'link' => 'http://guardian.co.uk/en-us', 'description' => 'rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed, sapien. Nunc pulvinar'],
                ['id' => 5, 'delivery_type_id' => 2, 'participation_id' => 4, 'path' => 'http://pinterest.com/sub', 'link' => 'https://pinterest.com/en-us', 'description' => 'vulputate, nisi sem semper erat, in consectetuer ipsum nunc id'],
                ['id' => 6, 'delivery_type_id' => 1, 'participation_id' => 9, 'path' => 'http://pinterest.com/sub/cars', 'link' => 'http://cnn.com/group/9', 'description' => 'magna nec quam. Curabitur vel lectus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur'],
                ['id' => 7, 'delivery_type_id' => 1, 'participation_id' => 6, 'path' => 'https://walmart.com/fr', 'link' => 'https://pinterest.com/sub/cars', 'description' => 'Curabitur consequat, lectus sit amet luctus vulputate, nisi sem semper erat,'],
                ['id' => 8, 'delivery_type_id' => 3, 'participation_id' => 2, 'path' => 'https://youtube.com/sub/cars', 'link' => 'http://whatsapp.com/settings', 'description' => 'Fusce aliquam, enim nec tempus scelerisque, lorem ipsum sodales purus, in molestie tortor nibh sit amet'],
                ['id' => 9, 'delivery_type_id' => 3, 'participation_id' => 2, 'path' => 'https://wikipedia.org/settings', 'link' => 'https://netflix.com/settings', 'description' => 'venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien. Cras dolor dolor, tempus non, lacinia at,'],
                ['id' => 10, 'delivery_type_id' => 1, 'participation_id' => 6, 'path' => 'https://baidu.com/sub', 'link' => 'http://cnn.com/group/9', 'description' => 'nisi a odio semper cursus. Integer mollis. Integer tincidunt aliquam arcu. Aliquam ultrices iaculis odio.'],

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
