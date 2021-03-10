<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('user_id');
            $table->string('name');
            #imagetable
            #like table
            $table->integer('likes');
            $table->string('title');
            $table->json('Description');
            $table->string('video_link')->nullable();
            #tagstable
            $table->string('tools')->nullable();;
            $table->string('status');
            $table->string('category');
            $table->json('tags')->nullable();
            $table->string('desc_seo')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
