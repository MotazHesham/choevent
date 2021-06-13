<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigrationsTable extends Migration
{
    public function up()
    {
        Schema::create('configrations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item')->nullable();
            $table->string('value')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
