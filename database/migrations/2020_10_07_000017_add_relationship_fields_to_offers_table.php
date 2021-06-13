<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOffersTable extends Migration
{
    public function up()
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->unsignedInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_2241485')->references('id')->on('orders');
            $table->unsignedInteger('service_provider_id')->nullable();
            $table->foreign('service_provider_id', 'service_provider_fk_2241486')->references('id')->on('users');
            $table->unsignedInteger('sponsor_id')->nullable();
            $table->foreign('sponsor_id', 'sponser_fk_2241489')->references('id')->on('users');
        });
    }
}
