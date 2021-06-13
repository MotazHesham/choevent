<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('code')->unique();
            $table->longText('description')->nullable();
            $table->float('discount', 5, 2)->nullable();
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
