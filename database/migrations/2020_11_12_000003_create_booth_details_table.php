<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoothDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('booth_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order')->nullable();
            $table->string('activity')->nullable();
            $table->float('length',6, 2)->nullable();
            $table->float('width', 6, 2)->nullable();
            $table->float('price', 15, 2)->nullable();
            $table->unsignedInteger('paid')->default(0);
            $table->string('marchent_id')->nullable();
            $table->unsignedInteger('booth_id')->nullable();
            $table->foreign('booth_id', 'booth_fk_2580368')->references('id')->on('booths');
            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
