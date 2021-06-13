<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('classification')->nullable();
            $table->decimal('price',10,2)->default(0.00);
            $table->text('description')->nullable();
            $table->integer('days')->nullable();
            $table->date('setup_date')->nullable();
            $table->boolean('publish')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
