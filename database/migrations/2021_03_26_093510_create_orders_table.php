<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->integer('expert_id');
            $table->integer('client_id');
            $table->enum('status', ['offer', 'ongoing','finish','delivery','completed','canceled']);
            $table->string('title');
            $table->longtext('description');
            $table->string('filename');
            $table->integer('budget');
            $table->enum('currency', ['usd','eur', 'rub','amd']);
            $table->date('to');
            $table->date('finish');
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
        Schema::dropIfExists('orders');
    }
}
