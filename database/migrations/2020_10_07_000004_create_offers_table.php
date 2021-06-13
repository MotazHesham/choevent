<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->decimal('price',10,2);
            $table->boolean('publish')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
