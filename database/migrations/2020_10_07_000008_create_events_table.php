<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->text('location_url')->nullable();
            $table->float('lat', 15, 10)->nullable();
            $table->float('lng', 15, 10)->nullable();
            $table->longText('description')->nullable();
            $table->datetime('start_at')->nullable();
            $table->datetime('end_at')->nullable();
            $table->integer('age_max')->nullable();
            $table->integer('age_min')->nullable();
            $table->string('nationality')->nullable();
            $table->string('sex')->nullable();
            $table->boolean('publish')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
