<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedInteger('event_id')->nullable();
            $table->foreign('event_id', 'event_fk_2241400')->references('id')->on('events');
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_2241402')->references('id')->on('categories');
            $table->unsignedInteger('service_provider_id')->nullable();
            $table->foreign('service_provider_id', 'service_provider_fk_2241404')->references('id')->on('users');
            $table->unsignedInteger('sponsor_id')->nullable();
            $table->foreign('sponsor_id', 'sponser_fk_2241405')->references('id')->on('users');
        });
    }
}
