<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBoothsTable extends Migration
{
    public function up()
    {
        Schema::table('booths', function (Blueprint $table) {
            $table->unsignedInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_2580184')->references('id')->on('events');
        });
    }
}
